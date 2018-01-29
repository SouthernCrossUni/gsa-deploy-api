package scu.gsa.deployment;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.InputStreamReader;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;

import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import org.apache.commons.lang3.StringEscapeUtils;

import java.io.IOException;

import org.unbescape.xml.XmlEscape;

public class Template extends ScuClasses {
	
	private String sourcePath = "https://t4prd-www.scu.edu.au";
	private String appName = "site-search";
	private String templateFileName = "scu_snippets.xslt";
	private Document doc;
	private File templateFile;
	private File frontendFile;
	private File shadowFile;
	private Boolean edited = false;
	private List<String> localWhiteList = new ArrayList<>(Arrays.asList("SCUCookie.js", "main.js", "styles.css", "t4_updates.css", "tiny-mce.css"));
	private List<String> resourceBlackList = new ArrayList<>(Arrays.asList("course-compare.js"));
	
	public void editTemplateFile(String find, String replace) throws RuntimeException {
		
		try {
			frontendFile = new File("bundles/apps/" + appName + "/frontends/" + templateFileName);
			File readerFile;
			if (!edited) {
				templateFile = new File("bundles/apps/" + appName + "/template/" + templateFileName);
				shadowFile = new File("bundles/apps/" + appName + "/template/shadow_" + templateFileName);
				shadowFile.createNewFile();
			}
			
			//writer
			FileWriter fileWriter = new FileWriter(frontendFile);
	        BufferedWriter out = new BufferedWriter(fileWriter);
	    	
			//reader
			FileReader fileReader = new FileReader(templateFile);
			BufferedReader in = new BufferedReader(fileReader);
			
			String inputLine;
			while ((inputLine = in.readLine()) != null) {
				inputLine = this.replaceDynamicSnippet(inputLine, find, replace);
				out.write(inputLine + "\n");
			}
			in.close();
			out.close();
			
	        this.copyFile(frontendFile, shadowFile);        
	        
			templateFile = new File("bundles/apps/" + appName + "/template/shadow_" + templateFileName);
			edited = true;
		} catch(IOException e) {
			throw new RuntimeException("Edit file failed: " + e.getMessage());
		}
	}
	
	public void copyFile(File inFile,File outFile) throws RuntimeException {
		try {
			FileInputStream inStream = new FileInputStream(inFile);
		    FileOutputStream outStream = new FileOutputStream(outFile);
		    
		    byte[] buffer = new byte[1024];
			 
			int length;
			/*copying the contents from input stream to
			 * output stream using read and write methods
			 */
			while ((length = inStream.read(buffer)) > 0){
				outStream.write(buffer, 0, length);
			}
			inStream.close();
			outStream.close();
		 } catch(IOException e){
			throw new RuntimeException("Copy file failed: " + e.getMessage());
    	 }

	}
	
	public void writeFooter() throws IOException {
		String footerHtml = this.cleanseLine(doc.select("footer").first().outerHtml(), "html", false);
		footerHtml = XmlEscape.escapeXml10(footerHtml);
		this.editTemplateFile("FOOTER_CONTENTS", footerHtml);
	}
		
	public void writeHeader() throws IOException {
		String headerHtml = this.cleanseLine(doc.select("header").first().outerHtml(), "html", false);
		headerHtml =  XmlEscape.escapeXml10(headerHtml);
		this.editTemplateFile("HEADER_CONTENTS", headerHtml);
	}
	
	public void writeCSS() throws RuntimeException {
		String contents = "";
		String styleWrapStart = "<style type=\"text/css\">\n";
		String styleWrapEnd = "</style>\n";
		Elements links = doc.select("link");
		try {
			for (Element element : links) {
//				System.out.println(element.attr("href"));
				String linkSource = "";
				String href = element.attr("href");
				if (this.absoluteLink(element.attr("href"), true) || this.absoluteLink(element.attr("href"), false)) {
					//absolute link found
					linkSource = href;
				} else {
//				} else if (!element.attr("href").contains("favico")) {
					linkSource = this.sourcePath + href;
				}			
				if (!linkSource.isEmpty() && this.makeLocal(linkSource)) {
					//get the unminified version to prevent double quote malformation
					System.out.println(getCurrentTimeStamp() +  " Making local copy of " + linkSource);
					contents += styleWrapStart;
					contents += this.contentsFromUrl(linkSource, false);
					contents += styleWrapEnd;
				} else {
					contents += element.outerHtml().replace(href, linkSource);;
				}
			}
			
			Elements styles = doc.select("style");
			for (Element element : styles) {
				contents += styleWrapStart;
				contents += element.html();
				contents += styleWrapEnd;
			}
			this.editTemplateFile("CSS_CONTENTS",  XmlEscape.escapeXml10(contents));
		} catch (IOException e) {
			throw new RuntimeException("Write CSS failed: " + e.getMessage());
		}
		
	}
	
	public void writeJS() throws RuntimeException {
		Elements scripts = doc.select("script");
		String contents = "";
		String scriptWrapStart = "<script type=\"text/javascript\">\n";
		String scriptWrapEnd = "</script>\n";
		
		try {
			for (Element element : scripts) {
				String linkSourceAffix = "";
				String linkSource;
				String src = element.attr("src");
				// is the src set
				if (src.length() > 0) {
					if (this.absoluteLink(src, true) || this.absoluteLink(src, false)) {
						// add https if its an absolute relative protocol link
						linkSourceAffix = (this.absoluteLink(src, true)) ? "https:" : "";
					} else {
						linkSourceAffix = this.sourcePath;
					}
					linkSource = linkSourceAffix + src;
					if (!this.isBlacklisted(linkSource)) {
						if (this.makeLocal(linkSource)) {
							System.out.println(getCurrentTimeStamp() +  " Making local copy of " + linkSource);
							contents += scriptWrapStart;
							contents += this.contentsFromUrl(linkSource, true);
							contents += scriptWrapEnd;
						} else {
							contents += element.outerHtml().replace(src, linkSource);	
						}
					}
					contents += "\n";
				}
			}
			this.editTemplateFile("JS_CONTENTS",  XmlEscape.escapeXml10(contents));
		} catch (Exception e) {
			throw new RuntimeException("Write JS failed: " + e.getMessage());
		}

	}
	
	public String contentsFromUrl(String source, Boolean removeComments) throws IOException {
		String contents = ""; 
		try {
			URLConnection lsc = new URL(source).openConnection();
	        BufferedReader in = new BufferedReader(new InputStreamReader(
	        		lsc.getInputStream()));
			String inputLine;
			while ((inputLine = in.readLine()) != null) 
				contents += this.cleanseLine(inputLine, "plain", removeComments) + "\n";
			in.close();
		} catch (IOException e) {
			throw new IOException("Contents from URL failed: " + e.getMessage());
		} catch (RuntimeException e) {
			throw new RuntimeException("contentsFromUrl parsing error for " + source + ": " + e.getMessage());
		}
		return contents;
	}
	
	public Boolean absoluteLink(String link, Boolean relativeProtocol) {
		String regex = (relativeProtocol) ? "//" : "http";
		Pattern pattern = Pattern.compile("^" + regex); 
		Matcher matcher = pattern.matcher(link);
		return matcher.find();
	}
	
	public String replaceDynamicSnippet(String line, String name, String replacement) {
		return line.replaceAll("\\[\\[" + name + "\\]\\]", Matcher.quoteReplacement(replacement));
	}
	
	public String cleanseLine(String line, String flag, Boolean removeComments) {
		
		List<String> regexes = new ArrayList<String>();
		List<String> replacements = new ArrayList<String>();
		// have we hit the GSA line bug limit for codeblocks
		if (removeComments) {
			// first remove any inline comments
			line = line.replaceAll("//(.|[\\r\\n]).*", "");			
		}		

		if (flag.equals("html")) {
			String htmlRegex = "\"/([^\"]*)";
			regexes.add("href=" + htmlRegex);
			regexes.add("src=" + htmlRegex);
			replacements.add("href=\"" + this.sourcePath + "/$1");
			replacements.add("src=\"" + this.sourcePath + "/$1"); 
		} else {
			regexes.add("url\\(./([^']*)'\\)");
			replacements.add("url('" + this.sourcePath + "/$1')"); 
		}
		
		for (String regex: regexes) {
			Pattern pattern = Pattern.compile(regex); 
			Matcher matcher = pattern.matcher(line);
			if (matcher.find()) {
				line = matcher.replaceAll(replacements.get(regexes.indexOf(regex)));	
			}
		}
		// remove fonts
		if (line.contains("site-assets/css/fonts/")) {
			System.out.println(getCurrentTimeStamp() + " Removing font line:" + line);
			line = "";
		}
		// remove comments from source
		return line;
	}
	
	public Boolean isBlacklisted(String source) {
		return matchToArrayList(resourceBlackList, source);
	}
	
	public Boolean makeLocal(String source) {
		return matchToArrayList(localWhiteList, source);
	}
	
	public void clean() throws RuntimeException {
		try {
			shadowFile.delete();
		} catch (SecurityException e) {
			throw new RuntimeException("Delete file failed: " + e.getMessage());
		}
	}
		
	public static void main(String[] args) {
		Template template = new Template();
		
		if (args.length > 0) {
			template.sourcePath = args[0];
		}
		if (args.length > 1) {
			template.templateFileName = args[1];
		}
		
		if (args.length > 2) {
			template.localWhiteList = Arrays.asList(args[2].split("\\s*,\\s*"));
		}
		
		if (args.length > 3) {
			template.resourceBlackList = Arrays.asList(args[3].split("\\s*,\\s*"));
		}
		
		try {
			template.doc = Jsoup.connect(template.sourcePath).get();
			System.out.println(getCurrentTimeStamp() +  " Writing Header");
			template.writeHeader();
			System.out.println(getCurrentTimeStamp() +  " Writing Footer");
			template.writeFooter();
			System.out.println(getCurrentTimeStamp() +  " Writing CSS");
			template.writeCSS();
			System.out.println(getCurrentTimeStamp() +  " Writing Javascript");
			template.writeJS();
			System.out.println(getCurrentTimeStamp() +  " Cleaning up...");
			template.clean();
		} catch (Exception e) {
			e.printStackTrace();
			System.exit(1);
		}		  
	}
}
