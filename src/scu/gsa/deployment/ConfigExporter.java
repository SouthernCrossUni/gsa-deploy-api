package scu.gsa.deployment;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;
import java.util.Properties;

import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;
import javax.xml.transform.Result;
import javax.xml.transform.Source;
import javax.xml.transform.Transformer;

import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.TransformerFactoryConfigurationError;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;

import org.tmatesoft.svn.core.SVNDepth;
import org.tmatesoft.svn.core.SVNException;

import org.tmatesoft.svn.core.internal.wc.DefaultSVNOptions;

import org.tmatesoft.svn.core.wc.ISVNStatusHandler;
import org.tmatesoft.svn.core.wc.SVNClientManager;
import org.tmatesoft.svn.core.wc.SVNRevision;
import org.tmatesoft.svn.core.wc.SVNStatus;
import org.tmatesoft.svn.core.wc.SVNStatusType;

import org.w3c.dom.Document;

import scu.gsa.deployment.Handler.ConfigImport;
import scu.gsa.deployment.Handler.DeployHandler;

import com.google.enterprise.apis.client.GsaClient;
import com.google.enterprise.apis.client.GsaEntry;

public class ConfigExporter extends ScuClasses  {
	
	public static void main(String args[]) throws Exception
	  { 
		
		Properties properties = new Properties();
		try {
			properties.load(new FileInputStream("config.properties"));
		} catch (IOException e) {
			System.err.println(e);
		}
		
		String deployFile = properties.getProperty("deployFile");
		File deployXml = new File(deployFile);
		
		SAXParserFactory factory = SAXParserFactory.newInstance();
		SAXParser saxParser = factory.newSAXParser();
		DeployHandler handler = new DeployHandler();
		handler.setDeployConfigPath(deployFile);
		saxParser.parse(deployXml, handler);		
		//grab current config from the handler
		ConfigImport config = handler.getConfigImport();
		//only care about the config key and path
		String configKey = config.getKey();
		String path = config.getPath();
		
		
		Map<String, String> queries = new HashMap<String, String>();
		queries.put("password", configKey);
		GsaClient scuClient = new ScuGsaClient().scuClient;
		GsaEntry entry;
		
		System.out.println("ATTEMPTING EXPORT of gsa config please wait..");
		try {
        
			entry = scuClient.queryEntry("config", "importExport", queries);
			//get xml export string from gsa entry
			String xmlData =  entry.getGsaContent("xmlData");
			System.out.println("EXPORT SUCCEEDED, converting to a document destination " + path);
			//construct a dom builder to parse the xml
			Document document = ConvertStringToXmlDoc(xmlData);
	        
	        //save the document
	        SaveGsaXml(document, path);
	        //commit the file
	        DoSVNCommit(path);
        
		} catch (Exception e) {
			e.printStackTrace(); 
		}
		 System.out.println("CONFIG XML EXPORT COMPLETE");
	  }
	
	private static void DoSVNCommit(String path) throws IllegalArgumentException {
		if (System.getenv("svn.user") != null && System.getenv("svn.password") != null) {
			String commitMsg = "***AUTO COMMIT***  GSA config file version using scu.gsa.deployment.ConfigExporter Class";     
	        final SVNClientManager cm = SVNClientManager.newInstance(new DefaultSVNOptions(), "bamboo", "WebSh00t");
	       
		     // Use do status to set deleted and added files information into SVN working copy management
		     try {
				cm.getStatusClient().doStatus(new File(path), SVNRevision.HEAD, SVNDepth.INFINITY, false, false, false, false, new ISVNStatusHandler() {
				             @Override
				             public void handleStatus(SVNStatus status) throws SVNException {
				                 if (SVNStatusType.STATUS_UNVERSIONED.equals(status.getNodeStatus())) {
				                     cm.getWCClient().doAdd(status.getFile(), true, false, false, SVNDepth.EMPTY, false, false);
				                 } else if (SVNStatusType.MISSING.equals(status.getNodeStatus())) {
				                     cm.getWCClient().doDelete(status.getFile(), true, false, false);
				                 }
				             }
				         }, null);
						 Long rev = cm.getCommitClient().doCommit(new File[]{new File(path)}, false, commitMsg, null, null, false, true, SVNDepth.INFINITY).getNewRevision();
					     System.out.println("CONFIG XML EXPORT COMMITTED TO SVN #" + rev);
			} catch (SVNException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}        
		    
		} else {
        	throw new IllegalArgumentException("SVN credentials not set");
        }
	}

	public static void SaveGsaXml(Document document, String path) throws TransformerFactoryConfigurationError, TransformerException {
		  System.out.println("CONVERSION SUCCEEDED, saving file");
	        //nconstruct a transformer to convert the dom into a stream
	        Transformer transformer = TransformerFactory.newInstance().newTransformer();
	        Result output = new StreamResult(new File(path));
	        Source input = new DOMSource(document);
	        transformer.transform(input, output);
	}
}
