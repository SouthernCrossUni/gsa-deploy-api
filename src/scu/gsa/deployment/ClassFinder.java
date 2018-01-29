package scu.gsa.deployment;

import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.util.ArrayList;
import java.util.Enumeration;
import java.util.List;
import java.util.jar.JarEntry;
import java.util.jar.JarFile;


/**
 * 
 * @author Sourced from Stack Overflow
 * http://stackoverflow.com/questions/15519626/how-to-get-all-classes-names-in-a-package
 * supports java 1.7 and used to get a list of classes from a package 
 * currenty constructed by Schema.java to push out tasks to xml that 
 * interface with DeploymentTask Exceptions
 *
 */

public class ClassFinder {

    private static final char PKG_SEPARATOR = '.';
    private static final char DIR_SEPARATOR = '/';
    private static final String CLASS_FILE_SUFFIX = ".class";
    private static final String BAD_PACKAGE_ERROR = "Unable to get resources from path '%s'. Are you sure the package '%s' exists?";
    

    public static List<Class<?>> find(String scannedPackage) {
    	//populate a list of classes ready for seeding
    	List<Class<?>> classes = new ArrayList<Class<?>>();
        String scannedPath = scannedPackage.replace(PKG_SEPARATOR, DIR_SEPARATOR);
        //get the url of the class loader resource
        URL scannedUrl = Thread.currentThread().getContextClassLoader().getResource(scannedPath);
        
        if (scannedUrl == null) {
            throw new IllegalArgumentException(String.format(BAD_PACKAGE_ERROR, scannedPath, scannedPackage));
        }
        //ant builds a jar, so without this stub it fails to seed in bamboo
        if (scannedUrl.toString().contains("jar:")) {
        	JarFile jarFile;
    		try {
    			//the ant build jars the file in lib, using the ant project name
    			jarFile = new JarFile("lib/GsaDeploy.jar");
    			Enumeration<JarEntry> allEntries = jarFile.entries();
    			//loop through all the jar entries found
              while (allEntries.hasMoreElements()) {
                  JarEntry entry = (JarEntry) allEntries.nextElement();
                  //get the name of the file in the entry
                  String file = entry.getName();
                  if (file.endsWith(CLASS_FILE_SUFFIX)) {
                      String classname = file.replace('/', '.').substring(0, file.length() - 6);
                      try {
                    	  //get the class from package using reflector name
                          Class<?> c = Class.forName(classname);
                          classes.add(c);
                      } catch (ClassNotFoundException e) {
                          System.out.println("WARNING: failed to instantiate " + classname + " from " + file);
                      }
                  }
              }
    		} catch (IOException e) {
    			e.printStackTrace();
    			System.exit(1);
    		}
    	//executing java classes outside of jar scope
        } else {
        	//get the dir of the url process and load files
            File scannedDir = new File(scannedUrl.getFile());

            for (File file : scannedDir.listFiles()) {
            	//add all the files from the package
                classes.addAll(find(file, scannedPackage));
            }
        }

        return classes;
    }   
    
    private static List<Class<?>> find(File file, String scannedPackage) {
    	//populate a list of classes ready for seeding
        List<Class<?>> classes = new ArrayList<Class<?>>();
        String resource = scannedPackage + PKG_SEPARATOR + file.getName();
        //recurse through directory and add classes 
        if (file.isDirectory()) {
            for (File child : file.listFiles()) {
                classes.addAll(find(child, resource));
            }
        //otherwise add sibling classes 
        } else if (resource.endsWith(CLASS_FILE_SUFFIX)) {
            int endIndex = resource.length() - CLASS_FILE_SUFFIX.length();
            String classname = resource.substring(0, endIndex);
            try {
            	//get the class from package using reflector name
                classes.add(Class.forName(classname));
            } catch (ClassNotFoundException e) {
            	System.out.println("WARNING: failed to instantiate " + classname + " from " + file);
            }
        }
        return classes;
    }

}