package scu.gsa.deployment;

import scu.gsa.deployment.Handler.DeployHandler;
import scu.gsa.deployment.Handler.XsltBundle;
import scu.gsa.deployment.Handler.VariableMap;

import com.google.enterprise.apis.client.GsaClient;
import com.google.enterprise.apis.client.GsaEntry;
import com.google.gdata.util.ServiceException;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Properties;

/**
* 	Used to import output format XSLT Stylesheets in GSA
*/

public class FrontEndWriter implements DeploymentTask
	{ 
	private static String envValue;
	

	public void run(DeployHandler handler, Properties properties) throws Exception
	{
		List<XsltBundle> xsltBundles = handler.getXsltBundle();
		List<VariableMap> varMap = handler.getVariableMap();

		//has the buildPath been set and did the xsltBundle prepare a populated list
		if (xsltBundles != null) {
			GsaClient scuClient = new ScuGsaClient().scuClient;
			for (XsltBundle bundle : xsltBundles) {
				// Create an entry to hold properties to update
				GsaEntry updateEntry = new GsaEntry();
				String feName = bundle.getName();
				updateEntry.setId(feName);
				 
				// The language parameter is passed as part of 
				//  the entry because we cannot use a query parameter
				updateEntry.addGsaContent("language", "en");

				String xsltContent = bundle.getContents();
				// Before adding the XSLT contents to the GSA
				// we need to parse it for variable mappings
				System.out.println("\nXSLT Parameter Parsing on " + feName + ".xslt started:\r");
				for(VariableMap map : varMap) {
					String match = map.getMatch();
					String envKey = map.getEnvKey();
					//is the environment variable available
					if (System.getenv(envKey) != null) {
						envValue = System.getenv(envKey);
						System.out.println("Replacing: " + match + " with " + envValue + "\r");
						xsltContent = xsltContent.replace(match, envValue);
					} 
				}
				 
				// Add this line to update the style sheet content
				updateEntry.addGsaContent("styleSheetContent", xsltContent);
				
				try {
					// Send the request 
					scuClient.updateEntry("outputFormat", feName, updateEntry);
				} catch (Exception e) {
					throw new ServiceException("Update Entry request failed: " + e.getMessage());
				}
			
				
				// Output results
				Map<String, String> queryMap = new HashMap<String, String>();
				// Initialize the query map
				queryMap.put("language", "en");
				GsaEntry myEntry = scuClient.queryEntry("outputFormat", feName, queryMap);
				
				//print the details reflecting the update
				System.out.println("\nLanguage: " + myEntry.getGsaContent("language") + "\n");
				System.out.println("FrontEnd Name: " + feName  + "\n");
				System.out.println("Is the Style Sheet Edited: " + myEntry.getGsaContent("isStyleSheetEdited") + "\n");
				System.out.println("XSLT Stylesheet Content: " + myEntry.getGsaContent("styleSheetContent")  + "\n");
			}
		
	} else {
		throw new DeploymentException(properties.getProperty("invalidDeployMsg") + " bad .xslt bundles setup");
	}
 }	
}
