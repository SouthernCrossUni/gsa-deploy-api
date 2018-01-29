package scu.gsa.deployment;

import scu.gsa.deployment.Handler.DeployHandler;
import scu.gsa.deployment.Handler.GsaCollection;

import com.google.enterprise.apis.client.GsaClient;
import com.google.enterprise.apis.client.GsaEntry;

import java.util.ArrayList;
import java.util.List;
import java.util.Properties;
import java.util.concurrent.TimeUnit;


public class Report extends ScuClasses implements DeploymentTask
	{
	
	 private Integer passLimit;
	 private Integer waitTime;
	 private Integer waitThreshold;
	 private String defaultRecipient = "gsa-reports@scu.edu.au";
	 
	 public void setPassLimit(Integer limit) {
		this.passLimit = limit;
	 }
		
	 public Integer getPassLimit() {
		return this.passLimit;
	 }
	 
	 public void setWaitTime(Integer seconds) {
		this.waitTime = seconds;
	 }
		
	 public Integer getWaitTime() {
		return this.waitTime;
	 }
	 
	 public void setWaitThreshold() {
		this.waitThreshold = (((this.passLimit)*this.waitTime)/60);
	 }
		
	 public Integer getWaitThreshold() {
		return this.waitThreshold;
	 }
	
	 
	 public static void createMonthlyReport(GsaClient myClient, String reportName, String collectionName, ArrayList<String> dateTags) {

		//the list is zero based, there is only ONE pathway that creates an index of one and that is automated monthlys
		//therefore only ever get this index if the naming convention begins with mth
		String dateTag = (reportName.matches("^mth")) ? dateTags.get(1) : dateTags.get(0);
		String results = (reportName.matches("(.*)no_res$")) ? "false" : "true";
		 System.out.println("using date tag:" + dateTag);
		 System.out.println("using report name:" + reportName);
		GsaEntry insertEntry = new GsaEntry();
		
		insertEntry.addGsaContent("reportName", reportName);
		insertEntry.addGsaContent("collectionName", collectionName);
		insertEntry.addGsaContent("reportDate", dateTag);
		insertEntry.addGsaContent("withResults", results);
		insertEntry.addGsaContent("topCount", "100");

		
		try {
			myClient.insertEntry("searchReport", insertEntry);
		} catch (Exception e) {
			// Handle the error
			System.err.println(e);
			System.exit(1);
		} 
		
	 }				
	 
	 public boolean reportIsReady(GsaClient myClient, String reportName, String collectionName, Integer iteration) {		
			
		 	if (iteration > 1) {
		 		try {
					Thread.sleep(1000*this.getWaitTime());    
				} catch (InterruptedException e) {
					Thread.currentThread().interrupt();
				}
		 	}
		 	
			try {
				GsaEntry entry = myClient.getEntry("searchReport", reportName + "@" + collectionName);
				return (entry.getGsaContent("reportState").equals("2") || entry.getGsaContent("reportState").equals("3"));
			} catch (Exception e) {
				// Handle the error
				//System.err.println(e);
				return false;
			}
	 }
	 
	 public void retrieveReports(GsaClient myClient, ReportDetails details) {
			
			Mailer mailer = new Mailer();
			mailer.setHost("smtp.scu.edu.au");
			mailer.setProps();
			String envRecipient = System.getenv("report.recipient");
			String recipient = (envRecipient != null && !envRecipient.isEmpty()) ? envRecipient : defaultRecipient;
		
			mailer.setRecipient(recipient);
			//mailer.setRecipient("scott.speers@scu.edu.au");
			mailer.setSender("gsa-donotreply@scu.edu.au");
			
			String subject = "GSA report package, wk " + details.currentWeek + ", mth " + details.currentMonth + ", " + details.currentYear;
			mailer.prepSubject(subject);
			
			mailer.setEmailBody("Please find attached the latest search report package.  This is an automated delivery from the SCU Google Search Appliance.  Please do not reply.");
			//set the properties of the attachment content list to 4/8 indices (we are using 2 collections @ 2/4 reports each)
			//this also sets it to an empty object instead of null
			mailer.propAttachmentContentList(8);
			mailer.propAttachmentNameList(8);
			
			for(GsaCollection collection : details.getCollectionList()) {
				String collectionName = collection.getName();
				try {
					//there are always multiple report names for a collection
					for (String reportName : details.getReportNames()) {
						GsaEntry entry = myClient.getEntry("searchReport", reportName + "@" + collectionName);
						details.setReportState(entry.getGsaContent("reportState"));
						details.setEntryId(entry.getGsaContent("entryID"));
						details.setReportDate(entry.getGsaContent("reportDate"));
						details.setResults(entry.getGsaContent("withResults"));
						details.setCount(entry.getGsaContent("topCount"));
						details.setDiagnostics(entry.getGsaContent("diagnosticTerms"));
						details.setReportFinality(entry.getGsaContent("isFinal"));
						details.setReportDate(entry.getGsaContent("reportCreationDate"));
						
						if (details.getReportState().equals("2") || details.getReportState().equals("3")) {
				
							mailer.addToAttachmentNameList(reportName + "." + collectionName + ".xml");
							mailer.addToAttachmentContentList(entry.getGsaContent("reportContent"));
							
							/*System.out.println("Entry Name: " + entry.getGsaContent("entryID"));
							System.out.println("Report State: " + entry.getGsaContent("reportState"));
							System.out.println("Report Creation Date: " + 
							  entry.getGsaContent("reportCreationDate"));
							System.out.println("Report Date: " + entry.getGsaContent("reportDate"));
							System.out.println("Is Final: " + entry.getGsaContent("isFinal"));
							System.out.println("With Results: " + entry.getGsaContent("withResults"));
							System.out.println("Top Count: " + entry.getGsaContent("topCount"));
							System.out.println("Diagnostic Terms: " + 
							  entry.getGsaContent("diagnosticTerms"));
							  System.out.println("Report Content: " + entry.getGsaContent("reportContent"));*/
							
						}
					}
				} catch (Exception e) {
					// Handle the error
					System.err.println(e);
				}
			}
			
			mailer.sendEmail();
	 }
	 
	 public static boolean isBetween(int value, int min, int max)
	{
	  return((value > min) && (value < max));
	}
	  
	  public void run(DeployHandler handler, Properties properties) throws Exception
	  {
				  
		//set default threshold
		this.setPassLimit(198);
		//set default wait time
		this.setWaitTime(30);
		this.setWaitThreshold();
		System.out.println("wait pass limit:" + this.getPassLimit());
		System.out.println("wait threshold:" + this.getWaitThreshold());
		
		//set default threshold based on above
		final Integer passLimit = this.getPassLimit();
		final Integer threshold = this.getWaitThreshold();	
		final GsaClient scuClient = new ScuGsaClient().scuClient;
						
		List<GsaCollection> gsaCollections = handler.getGsaCollections();
		
		if (gsaCollections != null) {
			try {				
				final ReportDetails details = new ReportDetails(scuClient, gsaCollections);
				ArrayList<String> reportNames = details.getReportNames();
				
				final Integer waitTime = this.waitTime;
				
				for(final GsaCollection collection : gsaCollections) { 
					
					for(final String reportName : reportNames) {

						if (!details.reportExists(collection.getName(), reportName)) {
							
							new Thread (new Runnable() {
								@Override
								public void run() {
									createMonthlyReport(scuClient, reportName, collection.getName(), details.getDateList());
									Integer tracker = new Integer(0);
																
									do {
										
										String timeStamp = String.format("%d min, %d sec", 
											    TimeUnit.SECONDS.toMinutes(tracker*waitTime),
											    TimeUnit.SECONDS.toSeconds(tracker*waitTime) - 
											    TimeUnit.MINUTES.toSeconds(TimeUnit.SECONDS.toMinutes(tracker*waitTime))
											);
										
					
										if (tracker.equals(0)) {
											System.out.println("Report " + reportName + "@" + collection.getName() + " is generating...");
										} else if (isBetween(tracker, 0, passLimit)) {
											System.out.println("Report " + reportName + "@" + collection.getName() + " is still generating....");
											System.out.println("Current wait time: " + timeStamp);
											System.out.println("Task will time out in: " +  (threshold - (tracker*waitTime)/60) + " minutes");
										} else {
											System.out.println("Stopping Job, report has taken too long to generate");
											System.exit(1);
										}
										
										tracker = new Integer(tracker.intValue() + 1);
										
									} while (!reportIsReady(scuClient, reportName, collection.getName(), tracker));
									
									unlockWaiter();
								}
							}).start();
							
							waitForThread();

						}	
					}
				}
				
				//now retrieve the reports
				retrieveReports(scuClient, details);
				
			} catch (Exception e) {
				// Handle the error
				System.err.println(e);
				System.exit(1);
			}
		} else {
			throw new DeploymentException(properties.getProperty("invalidDeployMsg") + " bad GsaCollection objects found in file: " + handler.getDeployConfigPath());
		}
	  }
	}
