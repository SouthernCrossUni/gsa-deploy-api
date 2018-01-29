package scu.gsa.deployment;

import com.google.enterprise.apis.client.GsaClient;
import com.google.enterprise.apis.client.GsaEntry;
import com.google.enterprise.apis.client.GsaFeed;

import scu.gsa.deployment.Handler.GsaCollection;

import java.util.*;  

class ReportDetails {
		private String reportName;
		private List<GsaCollection> reportCollections;
		private ArrayList<String> dateTagList = new ArrayList<String>(2);
		private ArrayList<String> reportNames = new ArrayList<String>(4);
		private Boolean newMonth;
		
		public Integer currentWeek;
		public Integer currentYear;
		public Integer currentMonth;
		private Integer lastSunday;
		private Integer lastMondayWeek;
		
		private Integer previousMonth;
		private Integer previousYear;
		private Integer lastDayMonth;
		private Integer firstDayMonth;
		
		
		//report elements from GSA
		private String reportEntryId;
		private String reportState;
		private String reportDate;
		private String reportFinality;
		private String reportResults;
		private String reportCount;
		private String reportDiagnostics;
		private GsaClient client;
		
		//legacy
		private String reportContent;
		
		public void seatGsaClient(GsaClient client) {
			this.client = client;
		}
		
		//public Boolean isFound(String collection, String reportName) {
			//return reportExists(collection);
		//}
		
		public ArrayList<String> getReportNames() {
			return this.reportNames;
		}
		
		public void addReportName(String name) {
			this.reportNames.add(name);
		}
		
		public void setReportName(String name) {
			this.reportName = name;
		}
		
		public String getReportName() {
			return this.reportName;
		}
		
		public List<GsaCollection> getCollectionList() {
			return this.reportCollections;
		}
		
		public ArrayList<String> getDateList() {
			return this.dateTagList;
		}
		
		public void setCollections(List<GsaCollection> gsaCollections) {
			this.reportCollections = gsaCollections;
		}
	
		public void addDateTag(String dateTag) {
			if (dateTag != null) {
				this.dateTagList.add(dateTag);
			}
		}
		
		public void setEntryId(String id) {
			this.reportEntryId = id;
		}
		
		public String getEntryId() {
			return this.reportEntryId;
		}
		
		public void setReportState(String state) {
			this.reportState = state;
		}
		
		public String getReportState() {
			return this.reportState;
		}
		
		public void setReportFinality(String finality) {
			this.reportFinality = finality;
		}
		
		public String getReportFinality() {
			return this.reportFinality;
		}
		
		public void setReportDate(String date) {
			this.reportDate = date;
		}
		
		public String getReportDate() {
			return this.reportDate;
		}
		
		public void setResults(String results) {
			this.reportResults = results;
		}
		
		public String getResults() {
			return this.reportResults;
		}
		
		public void setCount(String count) {
			this.reportCount = count;
		}
		
		public String getCount() {
			return this.reportCount;
		}
		
		public void setDiagnostics(String diagnostics) {
			this.reportDiagnostics = diagnostics;
		}
		
		public String getDiagnostics() {
			return this.reportDiagnostics;
		}
		
		public void setContent(String content) {
			this.reportContent = content;
		}
		
		public String getContent() {
			return this.reportContent;
		}
		
		 public boolean reportExists(String collection, String reportName) {
			try {
				GsaFeed myFeed = this.client.getFeed("searchReport");
				 
				for(GsaEntry entry : myFeed.getEntries()) {
					// these reports only run once a month and is always the previous month
					// therefore we can use the report name as the validator
					if (entry.getGsaContent("entryID").equals(reportName + "@" + collection)) {
						return true;
					}
				}
				return false;
			} catch (Exception e) {
				// Handle the error
				return false;
			}
	 }
		
		public ReportDetails(GsaClient myClient, List<GsaCollection> gsaCollections)
		{
			String dateTag; 
			//seat the instance
			this.seatGsaClient(myClient);
			String customString = System.getenv("custom.search.string");
			Calendar cal = Calendar.getInstance();
			
//			cal.set(Calendar.DAY_OF_MONTH, 6);
//			cal.set(Calendar.MONTH, 5);
			
			//prop the search string using date vars
			this.currentYear = cal.get(Calendar.YEAR);
			//need this for the weekly reports
			this.currentMonth = cal.get(Calendar.MONTH) + 1; //zero-based	

			if (customString == null || customString.isEmpty()) {
				//set boolean for new month
				this.newMonth = (cal.get(Calendar.WEEK_OF_MONTH) == 1) || (cal.get(Calendar.DAY_OF_MONTH) <= 6);

				//only prop the monthly range if its the beginning of a new month
				if (this.newMonth) {
					//new cal for monthly date range
					Calendar cal2 = Calendar.getInstance();
					
//						cal2.set(Calendar.DAY_OF_MONTH, 6);
//						cal2.set(Calendar.MONTH, 5);
					
					cal2.add(Calendar.MONTH, -1);
					
					this.previousYear = cal2.get(Calendar.YEAR); 
					//need this for the first week of every month
					this.previousMonth = cal2.get(Calendar.MONTH) + 1;
					this.firstDayMonth = cal2.getActualMinimum(Calendar.DAY_OF_MONTH);
					this.lastDayMonth = cal2.getActualMaximum(Calendar.DAY_OF_MONTH);
					
					cal2.set(Calendar.DAY_OF_WEEK, Calendar.SUNDAY);
					this.lastSunday = cal2.get(Calendar.DAY_OF_MONTH);
					
					//we need to calculate the previous week too so set it to the maximum of last month
					cal2.set(Calendar.WEEK_OF_MONTH, cal2.getActualMaximum(Calendar.WEEK_OF_MONTH));
					
					this.currentWeek = cal2.get(Calendar.WEEK_OF_YEAR);
					cal2.set(Calendar.DAY_OF_WEEK, Calendar.MONDAY);
					this.lastMondayWeek = cal2.get(Calendar.DAY_OF_MONTH);
					
					//monthly
					dateTag = "range_" + this.previousMonth + "_" + this.firstDayMonth + "_" + this.previousYear + "_" + this.previousMonth + "_" + this.lastDayMonth + "_" + this.previousYear;
					this.addReportName("mth_" + this.previousMonth + "_" + this.previousYear + "_no_res");
					this.addReportName("mth_" + this.previousMonth + "_" + this.previousYear + "_res");
					this.addDateTag(dateTag);
					
					//weekly
					dateTag = "range_" + this.previousMonth + "_" + this.lastMondayWeek + "_" + this.previousYear + "_" + this.currentMonth + "_" + this.lastSunday + "_" + this.previousYear;
					this.addDateTag(dateTag);
					//add the weekly names for no result and results
					this.addReportName("wk_" + this.currentWeek + "_" + this.previousYear + "_no_res");
					this.addReportName("wk_" + this.currentWeek + "_" + this.previousYear + "_res");
					
					
					
				} else {
					// Set the calendar to monday of the current week
					cal.set(Calendar.DAY_OF_WEEK, Calendar.MONDAY);
					cal.add(Calendar.WEEK_OF_MONTH, - 1);
					this.lastMondayWeek = cal.get(Calendar.DAY_OF_MONTH);
					
					cal.add(Calendar.WEEK_OF_MONTH, 1);
					//set integer for current week
					this.currentWeek = cal.get(Calendar.WEEK_OF_YEAR);
					cal.set(Calendar.DAY_OF_WEEK, Calendar.SUNDAY);
					this.lastSunday = cal.get(Calendar.DAY_OF_MONTH);
					
					//is the literal value of mondayweek greater than last sunday (have we gone into previous month)
					if (this.lastMondayWeek > this.lastSunday) {
						this.lastMondayWeek = 1;
					}
					
					dateTag = "range_" + this.currentMonth + "_" + this.lastMondayWeek + "_" + this.currentYear + "_" + this.currentMonth + "_" + this.lastSunday + "_" + this.currentYear;
					this.addDateTag(dateTag);
					//add the weekly names for no result and results
					this.addReportName("wk_" + this.currentWeek + "_" + this.currentYear + "_no_res");
					this.addReportName("wk_" + this.currentWeek + "_" + this.currentYear + "_res");
				}

			} else {
				//range_1_2_2009_9_23_2009
				if (customString.matches("^range_(\\d{1}|\\d{2})_(\\d{1}|\\d{2})_\\d{4}_(\\d{1}|\\d{2})_(\\d{1}|\\d{2})_\\d{4}")) {
					this.currentWeek = cal.get(Calendar.WEEK_OF_YEAR);
					this.addReportName("ctm_" + this.currentMonth + "_" + cal.get(Calendar.HOUR_OF_DAY) + cal.get(Calendar.MINUTE) + "_no_res");
					this.addReportName("ctm_" + this.currentMonth + "_" + cal.get(Calendar.HOUR_OF_DAY) + cal.get(Calendar.MINUTE) + "_res");
					this.addDateTag(customString);
				} else {
					throw new IllegalArgumentException("Invalid custom date string environment variable");
//					System.exit(1);
				}
			}
			//this.reportName = "report_" + monthNum + "_" + yearNum;
			//this.monthlyDateTag = "range_" + monthNum + "_" + yearNum;
			this.setCollections(gsaCollections);
		}
}