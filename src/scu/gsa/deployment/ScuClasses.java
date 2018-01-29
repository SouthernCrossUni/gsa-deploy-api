package scu.gsa.deployment;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.StringReader;
import java.io.UnsupportedEncodingException;
import java.nio.charset.Charset;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

import org.w3c.dom.Document;
import org.xml.sax.InputSource;
import org.xml.sax.SAXException;


public abstract class ScuClasses {
		
	public Boolean isNullOrEmpty(String string) {
		return (string != null && !string.isEmpty());
	}
	
	public static String readFile(String path, Charset encoding) throws IOException	{
		  byte[] encoded = Files.readAllBytes(Paths.get(path));
		  return new String(encoded, encoding);
	}
	
	 public static final Object monitor = new Object();
	 public static boolean monitorState = false;
	 
	 public static void waitForThread() {
		  monitorState = true;
		  while (monitorState) {
		    synchronized (monitor) {
		      try {
		        monitor.wait(); // wait until notified
		      } catch (Exception e) {}
		    }
		  }
		}
	 
	 public static void unlockWaiter() {
		  synchronized (monitor) {
		    monitorState = false;
		    monitor.notifyAll(); // unlock again
		  }
		}
	 
	 public static Document ConvertStringToXmlDoc(String xmlData) throws ParserConfigurationException, SAXException, IOException {
			DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
	        DocumentBuilder builder = factory.newDocumentBuilder();
	        Document document = builder.parse(new InputSource(new StringReader(xmlData)));
	        return document;
	 }
	 public static String getCurrentTimeStamp() {
		    return new SimpleDateFormat("yyyy-MM-dd HH:mm:ss.SSS").format(new Date());
	}
	 
	public static Boolean matchToArrayList(List<String> list, String source) {
		Boolean matched = false;
		if (!source.isEmpty() && source != null) {
			for (String test : list) {
				Pattern pattern = Pattern.compile(test);
	            Matcher matcher = pattern.matcher(source);
	            if (matcher.find()) {
	            	matched = true;
	            	break;
	            }
			} 
		}
		return matched;
	}
	 
}