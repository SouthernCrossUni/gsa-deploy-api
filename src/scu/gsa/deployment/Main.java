package scu.gsa.deployment;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.IOException;
import java.lang.reflect.InvocationTargetException;
import java.lang.reflect.Method;
import java.util.List;
import java.util.Properties;

import javax.xml.parsers.ParserConfigurationException;
import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;

import org.xml.sax.SAXException;

import scu.gsa.deployment.Handler.DeployHandler;
import scu.gsa.deployment.Handler.DeploymentNamespace;
import scu.gsa.deployment.Handler.Task;

/**
*  Main Class implements a primary switch interface 
*  for all standard SCU GSA Deployment methods
**/

public class Main extends ScuClasses implements DeploymentTask
	{				
		public static void wrapException(InvocationTargetException e, String task) throws DeploymentException {
			 Throwable cause = e.getCause();
			 e.printStackTrace();
			 System.out.format("Invocation of %s failed with '%s'%n", task, cause.getMessage());
			 throw new DeploymentException(task + " failed.");
		}
		
		public static void main(String args[]) throws ParserConfigurationException, SAXException, IOException  
		  { 
			Properties properties = new Properties();
			try {
				properties.load(new FileInputStream("config.properties"));
			} catch (IOException e) {
				System.err.println(e);
			}
			
			String deployFile = properties.getProperty("deployFile");
			String stableEnv = properties.getProperty("stableEnv");
			String testEnv = properties.getProperty("testEnv");
			
			//did any of the properties fail to be set
			if (deployFile == null || stableEnv == null || testEnv == null) {
				throw new IllegalArgumentException(properties.getProperty("invalidEnvMsg") + ", property file values not set");
			}
			System.out.println("Deploying to GSA using this config\n");
			try (BufferedReader br = new BufferedReader(new FileReader(deployFile))) {
				   String line = null;
				   while ((line = br.readLine()) != null) {
				       System.out.println(line.replace("><", ">\n<"));
				   }
				}			
			
			File deployXml = new File(deployFile);
			SAXParserFactory factory = SAXParserFactory.newInstance();
			SAXParser saxParser = factory.newSAXParser();
			DeployHandler handler = new DeployHandler();
			handler.setDeployConfigPath(deployFile);
			saxParser.parse(deployXml, handler);			
			
			//get list of configured tasks from deploy.xml
			DeploymentNamespace namespace = handler.getDeploymentNamespace();
			List<Task> tasks = handler.getDeploymentTasks();			
			try {
				//get the main target class to run and the current Bamboo deployment environments
			  	String deployEnv = System.getenv("bamboo_deploy_environment");
			  	String targetTask = System.getenv("deployment.task");
			  	
				if (targetTask != null && deployEnv != null) {
					Boolean validTaskName = false;
					for(Task task : tasks) {
						//is the task name matched
						if (targetTask.equals(task.getName())) {
							validTaskName = true;
							if (!namespace.getLifecycle().equals("stable") && deployEnv.equals(stableEnv)) {
								throw new IllegalArgumentException(properties.getProperty("invalidDeployMsg") + ", cannot deploy unstable tasks to " + deployEnv);
							} else {
								Class<?> deployClass = Class.forName("scu.gsa.deployment." + targetTask);
								Object deployObject = deployClass.newInstance();
								try {
									Method method = deployObject.getClass().getDeclaredMethod("run", DeployHandler.class, Properties.class);
									method.invoke(deployObject,handler,properties);
								} catch (InvocationTargetException e) {
									 wrapException(e, targetTask);
								}
							}
						}
					}
				
					
					if (!validTaskName) {
						throw new IllegalArgumentException("Deployment task " + targetTask + " Not Found");
					}
					
//					//handle the target with an actual class in deployment library
//					switch(target) {
//						case "SEARCH_REPORT":
//							 try {
//								Report report = new Report();
//								report.run(args);
//							 }
//							 catch (Exception e) {
//								 wrapException(e, target);
//							 }		
//						break;
//						case "FRONT_END_IMPORT":
//							 try {
//								FrontEndImport scuImport = new FrontEndImport();
//								scuImport.run(handler);
//							 }
//							 catch (Exception e) {
//								 wrapException(e, target);
//							 }		
//						break;
//						default:
//							throw new IllegalArgumentException("Deployment task " + target + " Not Found");
//					}
				} else {
					throw new IllegalArgumentException(properties.getProperty("invalidEnvMsg") + " deployment.task and bamboo environment not set");
				}
				
			} catch (Exception e) {
				System.err.println(e.getMessage());
				System.exit(1);
			}
		  	
		 }
	}
