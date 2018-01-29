package scu.gsa.deployment;

import java.io.IOException;
import java.util.Properties;

import com.google.enterprise.apis.client.GsaClient;
import com.google.enterprise.apis.client.GsaEntry;
import com.google.gdata.util.ServiceException;

import scu.gsa.deployment.Handler.ConfigImport;
import scu.gsa.deployment.Handler.DeployHandler;


public class ConfigImporter extends ScuClasses implements DeploymentTask
	{ 
	  
	public void run(DeployHandler handler, final Properties properties) throws DeploymentException
	{	
		//grab config from the handler
		ConfigImport config = handler.getConfigImport();
		if (config.isValid()) {
			//get config contents
			final String configData = config.getContents();
			//get the passphrase key
			final String configKey = config.getKey();
			//construct the client
			final GsaClient scuClient = new ScuGsaClient().scuClient;
			
			System.out.println("ATTEMPTING IMPORT OF CONFIG: " + config.getPath() + " please wait..");
			try {
				GsaEntry updateEntry = new GsaEntry();
				updateEntry.addGsaContent("xmlData", configData);
				updateEntry.addGsaContent("password", configKey);
				scuClient.updateEntry("config", "importExport", updateEntry);
			} catch (ServiceException | IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
						
			System.out.println("CONFIG IMPORT COMPLETE..."); 
		} else {
			throw new DeploymentException(properties.getProperty("invalidDeployMsg") + " bad config provided or config not found, please review " + properties.getProperty("deployFile"));
		}
	 }	
//	
//	public Boolean configImportComplete(GsaClient scuClient, String configKey, String configData, Integer tracker) {
//		//get target host
//		String gsaHost = System.getenv("gsa.host");
//		
//		if (tracker > 1) {
//	 		try {
//				Thread.sleep(1000*5);    
//			} catch (InterruptedException e) {
//				Thread.currentThread().interrupt();
//			}
//	 	}
//	 	
//		try {
//			CloseableHttpClient httpClient = HttpClients.createDefault();
//			RequestConfig requestConfig = RequestConfig.custom()
//			        .setSocketTimeout(5000)
//			        .setConnectTimeout(5000)
//			        .build();
//			HttpGet httpGet = new HttpGet("http://" + gsaHost + ":8000");
//			httpGet.setConfig(requestConfig);
//			
//			CloseableHttpResponse httpResponse = httpClient.execute(httpGet);
//			httpResponse.close();
//			return (httpResponse.getStatusLine().toString().contains("200"));
////			return (response.toString().equals("200"));
//		} catch (Exception e) {
//			// Handle the error
//			System.err.println(e);
//			return false;
//		} 
//		
//	}
	
	}
