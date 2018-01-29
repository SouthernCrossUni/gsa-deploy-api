package scu.gsa.deployment;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import org.apache.commons.lang3.StringEscapeUtils;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class JsonList extends ScuClasses {
	
	private String sourcePath = "https://t4prd-www.scu.edu.au/study-at-scu/course-search";
	private String appName = "course-search";
	private String listFilename = "subjectAreas.json";
	private String listPath = "bundles/apps/" + this.appName + "/resources/search/courses";
	private String listSelector = "#filter4 label";
	private String listValue = "text";
	private Document doc;
	private File listFile;
	private List<String> listKeys = new ArrayList<>(Arrays.asList("business", "creative", "education", "environment", "health", "arts", "indigenous", "information", "law", "tourism"));
	private List<String> notContainsList = new ArrayList<>(Arrays.asList("Generic", "Gen"));
	
	public void writeToListFile(String listContents) throws RuntimeException {
		try {
			listFile = new File(listPath + "/" + listFilename);
			//writer
			FileWriter fileWriter = new FileWriter(listFile);
	        BufferedWriter out = new BufferedWriter(fileWriter);
	        out.write(listContents);		
			out.close();
		} catch(IOException e) {
			throw new RuntimeException("Write file failed: " + e.getMessage());
		}
	}
	
	public void writeList() throws IOException {
		if (!notContainsList.isEmpty()) {
			listSelector = listSelector + ":not(";
			for (String notContains : notContainsList) {
				listSelector += ":contains(" +  notContains + "),";	
				if ((notContainsList.indexOf(notContains) == (notContainsList.size() -1))) {
					listSelector = listSelector.replaceAll(",$", "");
				}
			}
			listSelector = listSelector + ")";
			
		}
		System.out.println(getCurrentTimeStamp() +  " selecting with " + listSelector + " as a \"" + listValue + "\" type");
	
		Elements list = doc.select(listSelector);
		String listContents = "[{";
		if (listValue.equals("text")) {
			for (Element listElement : list) {
				String key = listKeys.get(list.indexOf(listElement));
				listContents += "\"" + key + "\":\"" + StringEscapeUtils.escapeJson(listElement.ownText()) + "\",";
				if ((list.indexOf(listElement) == (list.size() -1))) {
					listContents = listContents.replaceAll(",$", "");
				}
			}
		}
		listContents += "}]";
		this.writeToListFile(listContents);
	}
			
	public static void main(String[] args) {
		JsonList json = new JsonList();
		
		if (args.length > 0) {
			json.sourcePath = args[0];
		}
		if (args.length > 1) {
			json.listFilename = args[1];
		}
		if (args.length > 2) {
			json.listSelector = args[2].replaceAll("\\[space\\]", " ");
		}		
		if (args.length > 3) {
			json.listValue = args[3];
		}
		
		if (args.length > 4) {
			json.listKeys = Arrays.asList(args[4].split("\\s*,\\s*"));
		}
		
		if (args.length > 5) {
			json.notContainsList = Arrays.asList(args[5].split("\\s*,\\s*"));
		}
		
		try {
			json.doc = Jsoup.connect(json.sourcePath).get();
			System.out.println(getCurrentTimeStamp() +  " Writing List for " + json.listFilename);
			json.writeList();
		} catch (Exception e) {
			e.printStackTrace();
			System.exit(1);
		}		  
	}
}
