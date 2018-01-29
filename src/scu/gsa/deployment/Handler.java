package scu.gsa.deployment;
import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.List;

import org.apache.commons.lang3.StringEscapeUtils;
import org.xml.sax.Attributes;
import org.xml.sax.SAXException;
import org.xml.sax.helpers.DefaultHandler;

public class Handler extends ScuClasses {
		private static String xsltAffix = "bundles/apps/";
		
		public static class GsaCollection {
		    private String appRef;
		    private String name;
		    private String badUrls;
		    private String goodUrls;
		    private String preReqResults;
		    private String testWords;
		     
		    public String getAppRef() {
		        return appRef;
		    }
		    public void setAppRef(String ref) {
		        this.appRef = ref;
		    }
		    public String getName() {
		        return name;
		    }
		    public void setName(String name) {
		        this.name = name;
		    }
			public String getBadUrls() {
				return badUrls;
			}
			public void setBadUrls(String badUrls) {
				this.badUrls = badUrls;
			}
			public String getGoodUrls() {
				return goodUrls;
			}
			public void setGoodUrls(String goodUrls) {
				this.goodUrls = goodUrls;
			}
			public String getTestWords() {
				return testWords;
			}
			public void setTestWords(String testWords) {
				this.testWords = testWords;
			}
			public String getPreReqResults() {
				return preReqResults;
			}
			public void setPreReqResults(String preReqResults) {
				this.preReqResults = preReqResults;
			}

		}
				
		public static class XsltBundle {
		    private String appRef;
		    private String name;
		    private String content;
		     
		    public String getAppRef() {
		        return appRef;
		    }
		    public void setAppRef(String ref) {
		        this.appRef = ref;
		    }
		    public String getName() {
		        return name;
		    }
		    public void setName(String name) {
		        this.name = name;
		    }
		    public String getContents() {
		        return content;
		    }
		    public void setContents(String content) {
		        this.content = content;
		    }
		}
		
		public static class ConfigImport {
		    private String path;
		    private String key;
		    private String contents;
		    private Boolean valid = false;
		     
		    public String getPath() {
		        return path;
		    }
		    public void setPath(String file) {
		        this.path = file;
		    }
		    public String getKey() {
		        return key;
		    }
		    public void setKey(String key) {
		        this.key = key;
		    }
			public Boolean isValid() {
				return valid;
			}
			public void setValid(Boolean valid) {
				this.valid = valid;
			}
			public String getContents() {
				return contents;
			}
			public void setContents(String contents) {
				this.contents = contents;
			}
		}
		
		public static class VariableMap {
		    private String match;
		    private String envKey;
		     
		    public String getMatch() {
		        return match;
		    }
		    public void setMatch(String match) {
		        this.match = match;
		    }
		    public String getEnvKey() {
		        return envKey;
		    }
		    public void setEnvKey(String key) {
		        this.envKey = key;
		    }

		}
		
		public static class Task {
		    private String name;
		     
		    public String getName() {
		        return name;
		    }
		    public void setName(String name) {
		        this.name = name;
		    }

		}
		
		public static class DeploymentNamespace {
		    private String project;
		    private String version;
		    private String lifecycle;
		     
		    public String getProject() {
		        return project;
		    }
		    public void setProject(String project) {
		        this.project = project;
		    }
			public String getLifecycle() {
				return lifecycle;
			}
			public void setLifecycle(String lifecycle) {
				this.lifecycle = lifecycle;
			}
			public String getVersion() {
				return version;
			}
			public void setVersion(String version) {
				this.version = version;
			}

		}
		
		
		public static class DeployHandler extends DefaultHandler {
			private List<XsltBundle> xbList = null;
			private List<VariableMap> vmList = null;
			private List<GsaCollection> gcList = null;
			private List<Task> dtList = null;
			
			private XsltBundle xsltBundle = null;
			private VariableMap varMap = null;
			private GsaCollection gsaCollection = null;
			private Task deployTask = null;
			
			private ConfigImport importConfig = new ConfigImport();
			private DeploymentNamespace namespace = new DeploymentNamespace();

			private Boolean validAddition;
			private String deployFilePath;
			
			public ConfigImport getConfigImport() {
				return this.importConfig;
			}
			
			public DeploymentNamespace getDeploymentNamespace() {
				return this.namespace;
			}
			
			public List<XsltBundle> getXsltBundle() {
				  return this.xbList;
			}
			
			public List<VariableMap> getVariableMap() {
				  return this.vmList;
			}
			
			public List<GsaCollection> getGsaCollections() {
				  return this.gcList;
			}
			
			public List<Task> getDeploymentTasks() {
				  return this.dtList;
			}			
			
			@Override
			public void startElement(String uri, String localName, String qName, Attributes attributes) throws SAXException {
				//moderate types
				//frontend nodes
				if (qName.equalsIgnoreCase("frontend")) {
					try {
						String feName = attributes.getValue("name");
						String appRef = attributes.getValue("appRef");
						xsltBundle = new XsltBundle();
						xsltBundle.setAppRef(appRef);
						xsltBundle.setName(feName);
						String xlstContent = readFile(xsltAffix + "/"  +appRef + "/frontends/" + attributes.getValue("name") + ".xslt", StandardCharsets.UTF_8);
						xlstContent = StringEscapeUtils.escapeXml11(xlstContent);	
						xsltBundle.setContents(xlstContent);

					} catch (IOException e) {
						throw new RuntimeException("failed to stringify the xslt bundle: " + e.getMessage());
					}
					
					if (xbList == null) {
						xbList = new ArrayList<>();
					}
				//collection nodes
				} else if (qName.equalsIgnoreCase("collection")) {
					String name = attributes.getValue("name");
					String appRef = attributes.getValue("appRef");
					gsaCollection = new GsaCollection();
					gsaCollection.setAppRef(appRef);
					gsaCollection.setName(name);
				
					if (gcList == null) {
						gcList = new ArrayList<>();
					}
				//config nodes
				} else if (qName.equalsIgnoreCase("config")) {
//					    <config file="config.xml" key="webdev2015" target="false" rollback="false"/>
//					    <config file="config_dev.xml" key="scugsa20" target="true" rollback="config.xml"/>
					String path = attributes.getValue("path");
					String key = attributes.getValue("key");
					if (!path.isEmpty() && !key.isEmpty()) {
						try {
							importConfig.setPath(path);
							importConfig.setKey(key);
							String configContent = readFile(path, StandardCharsets.UTF_8);
//							configContent = StringEscapeUtils.escapeXml11(configContent);
							importConfig.setContents(configContent);
							//override default to true
							importConfig.setValid(true);
						} catch (IOException e) {
							throw new RuntimeException("failed to stringify config import file: " + e.getMessage());
						}
					}					
				//simple types
				} else if (qName.equalsIgnoreCase("variable")) {
					String match = attributes.getValue("match");
					String key = attributes.getValue("envKey");
					varMap = new VariableMap();
					varMap.setMatch(match);
					varMap.setEnvKey(key);
					
					if (vmList == null) {
						vmList = new ArrayList<>();
					}
				} else if (qName.equalsIgnoreCase("task")) {
					String name = attributes.getValue("name");
					deployTask = new Task();
					deployTask.setName(name);
					
					if (dtList == null) {
						dtList = new ArrayList<>();
					}
				
				} else if (qName.equalsIgnoreCase("deployment")) {
					String project = attributes.getValue("project");
					String version = attributes.getValue("version");
					String lifecycle = attributes.getValue("lifecycle");
					namespace.setProject(project);
					namespace.setVersion(version);
					namespace.setLifecycle(lifecycle);
				}
			}
			
			@Override
			public void endElement(String uri, String localName, String qName) throws SAXException {
				//moderate types
				//frontend nodes
		        if (qName.equalsIgnoreCase("frontend")) {
		        	if (xsltBundle != null) {
		        		validAddition = true;
			        	//if a previous bundle has been added
			        	if (xbList.size() > 0) {
			        		//get the last bundle so we can check its appRef
			        		XsltBundle prevXb = xbList.get(xbList.size() -1);
			        		//if the ref integrity do not match
			        		if (!prevXb.getAppRef().equals(xsltBundle.getAppRef())) {
			        			validAddition = false;
			        		}
			        	} 
			        	
			        	if(validAddition) {
			        		//add bundle object to list
					        	xbList.add(xsltBundle);
			        	} else {
			        		throw new IllegalArgumentException("Invalid " + qName + " reference key was found");
			        	}
		        	}	
		        //collection nodes
				} else if (qName.equalsIgnoreCase("collection")) {
		        	if (gsaCollection != null) {
		        		validAddition = true;
			        	//if a previous bundle has been added
			        	if (gcList.size() > 0) {
			        		//get the last bundle so we can check its appRef
			        		GsaCollection prevGc = gcList.get(gcList.size() -1);
			        		//if the ref integrity do not match
			        		if (!prevGc.getAppRef().equals(gsaCollection.getAppRef())) {
			        			validAddition = false;
			        		}
			        	} 
			        	
			        	if(validAddition) {
			        		//add bundle object to list
			        		gcList.add(gsaCollection);
			        	} else {
			        		throw new IllegalArgumentException("Invalid " + qName + " reference key was found");
			        	}
		        	}		
		        //simple types
				} else if (qName.equalsIgnoreCase("variable")) {
		        	//add variable mapping object to list
					vmList.add(varMap);
		        } else if (qName.equalsIgnoreCase("task")) {
		        	//add task mapping object to list
		        	dtList.add(deployTask);
				}
			}
			

			public String getDeployConfigPath() {
				return deployFilePath;
			}

			public void setDeployConfigPath(String configPath) {
				this.deployFilePath = configPath;
			}
		}
		
		//entities specific to the GSA Config Mapper
		public static class GsaFrontEnd {
			private String name;
			private String defaultLanguage;
			private String profileSheet;
			private String profileSheetEn;
			private String badUrlsNoReturn;
			private String domainFilter;
			private String fileTypeFilter;
			private String goodIPs;
			private String googleMatch;
			private String langFilter;
			private String metatagFilter;
			private String queryExpansionFilter;
			private String queryExpansionMetaFilter;
			private String scoringPolicyFilter;
			private String starWildCardDefaultFilter;
			private String styleSheet;
			private String synonyms;
			private String wildCardWCFilter;
			
			public String getName() {
				return name;
			}

			public void setName(String name) {
				this.name = name;
			}

			public String getProfileSheet() {
				return profileSheet;
			}

			public void setProfileSheet(String profileSheet) {
				this.profileSheet = profileSheet;
			}

			public String getProfileSheetEn() {
				return profileSheetEn;
			}

			public void setProfileSheetEn(String profileSheetEn) {
				this.profileSheetEn = profileSheetEn;
			}

			public String getDefaultLanguage() {
				return defaultLanguage;
			}

			public void setDefaultLanguage(String defaultLanguage) {
				this.defaultLanguage = defaultLanguage;
			}

			public String getBadUrlsNoReturn() {
				return badUrlsNoReturn;
			}

			public void setBadUrlsNoReturn(String badUrlsNoReturn) {
				this.badUrlsNoReturn = badUrlsNoReturn;
			}

			public String getFileTypeFilter() {
				return fileTypeFilter;
			}

			public void setFileTypeFilter(String fileTypeFilter) {
				this.fileTypeFilter = fileTypeFilter;
			}

			public String getGoodIPs() {
				return goodIPs;
			}

			public void setGoodIPs(String goodIPs) {
				this.goodIPs = goodIPs;
			}

			public String getDomainFilter() {
				return domainFilter;
			}

			public void setDomainFilter(String domainFilter) {
				this.domainFilter = domainFilter;
			}

			public String getGoogleMatch() {
				return googleMatch;
			}

			public void setGoogleMatch(String googleMatch) {
				this.googleMatch = googleMatch;
			}

			public String getLangFilter() {
				return langFilter;
			}

			public void setLangFilter(String langFilter) {
				this.langFilter = langFilter;
			}

			public String getMetatagFilter() {
				return metatagFilter;
			}

			public void setMetatagFilter(String metatagFilter) {
				this.metatagFilter = metatagFilter;
			}

			public String getQueryExpansionFilter() {
				return queryExpansionFilter;
			}

			public void setQueryExpansionFilter(String queryExpansionFilter) {
				this.queryExpansionFilter = queryExpansionFilter;
			}

			public String getQueryExpansionMetaFilter() {
				return queryExpansionMetaFilter;
			}

			public void setQueryExpansionMetaFilter(String queryExpansionMetaFilter) {
				this.queryExpansionMetaFilter = queryExpansionMetaFilter;
			}

			public String getScoringPolicyFilter() {
				return scoringPolicyFilter;
			}

			public void setScoringPolicyFilter(String scoringPolicyFilter) {
				this.scoringPolicyFilter = scoringPolicyFilter;
			}

			public String getStarWildCardDefaultFilter() {
				return starWildCardDefaultFilter;
			}

			public void setStarWildCardDefaultFilter(String starWildCardDefaultFilter) {
				this.starWildCardDefaultFilter = starWildCardDefaultFilter;
			}

			public String getStyleSheet() {
				return styleSheet;
			}

			public void setStyleSheet(String styleSheet) {
				this.styleSheet = styleSheet;
			}

			public String getSynonyms() {
				return synonyms;
			}

			public void setSynonyms(String synonyms) {
				this.synonyms = synonyms;
			}

			public String getWildCardWCFilter() {
				return wildCardWCFilter;
			}

			public void setWildCardWCFilter(String wildCardWCFilter) {
				this.wildCardWCFilter = wildCardWCFilter;
			}
		}
		
		
		public static class GsaGlobalParameters {
			private String googleAppsDomain;
			private String aclInheritance;
			private String activeLanguageBundle;
			private String adminConsoleAuthMode;
			private String adminHttpEnable;
			private String alerts;
			private String alertFooterEmail;
			private String alertHeaderEmail;
			private String authDomains;
			private String authClientCert;
			private String authOneBoxCert;
			private String authServerCert;
			private String authnArtifactServiceUrl;
			private String authnLoginUrl;
			private String authzServiceUrl;
			private String autoComplete;
			
			private String backoffRemoveIndex;
			private String badUrls;
			private String basicAuthChallengeType;
			private String batchCrawlMode;
			
			private String clickBoost;
			private String clickBoostData;
			private String clickBoostSummaryData;
			private String clickJackingDefense;
			private String clickLogging;
			
			private String lowercaseUrls;
			private String cookieDomain;
			private String coverageConfig;
			
			private String defaultSearchUrl;
			private String delegatedAuthZ;
			private String denyRulesConfig;
			private String disableInfiniteSpace;
			private String disableLegacyAuthN;
			private String dnsOverride;
			
			private String doEntityExtraction;
			private String docuMillDiskSizeLimit;
			private String docuMillDiskSizeBuffer;
			private String docuMillMaxPages;
			private String docuMillNumThreads;
			private String docuMillResolution;
			private String dupHosts;
			
			private String enableCheckSuggestsExistInIndex;
			private String enableContextSynsOneWordQueries;
			private String enableTrustStore;
			private String enableDiacriticalEq;
			private String enableDiacrititcsExpansion;
			private String enableDirtyWords;
			private String enableDocuMill;
			private String enableInfiniteSpaceDetection;
			private String enableKerberosCrawling;
			private String enableLateBindingACL;
			private String enableLogManager;
			private String enablePartialFieldsExpansion;
			private String enablePhraseSuggest;
			private String enableQueryLogSuggest;
			private String enableSecureSearch;
			private String enableSNMP;
			private String enableUARSuggest;
			private String enableFeedergateClientCerts;
			private String enableFeedergateHttp;
			
			private String enterpriseCrowdingConfig;
			private String entityDefinition;
			private String entityDictionaryCount;
			private String entityDictionaryList;
			private String entityGrammarsDefinition;
			private String entityMaxWords;
			private String entityPunctuationFile;
			private String entityPunctuationSpaceFile;
			private String entityBlacklist;
			
			private String escorerGaConfig;
			private String estimatesInSecureSearches;
			private String expertSearchConfig;
			private String externalSSH;
			
			private String federationConfig;
			private String federationEnabled;
			private String federationUIEnabled;
			private String feederConnectorManagerTrustedClients;
			private String feederTrustedClients;
			private String footerEmail;
			private String headerEmail;
			
			private String forceRecrawlUrls;
			private String frequentUrls;
			private String kmStart;
			private String ldapConfig;
			private String ldapManagerGroup;
			private String ldapSupervisorGroup;
			private String ldapSuperUserGroup;
			private String goodUrls;
			private String googleAppsUnificationEnabled;
			
			//SAML
			private String gsaEntityId;
			private String samlMetadata;
			
			private String httpHeaders;
			private String ignoreAnchorsForSnippets;
			private String indexServerDropDenyDecision;
			private String infrequentUrls;
			private String outgoingSender;
			
			private String multiBoxUIEnabled;
			private String notificationEmail;
			private String onboardSecurityManagerEnabled;
			
			//dynamic nav
			private String parametricConfigHasEntities;
			private String parametricSearchConfig;
			private String parametricSearchEnabled;
			
			private String peopleSearchConfig;
			private String peopleSearchMaxResults;
			private String perimeterSecurityEnabled;
			
			private String problemEmail;
			private String proxyConfig;
			private String queryExpStatus;
			private String redirectHttps;
			private String remoteCollectionsConfig;
			private String remoteFrontendFilterEnabled;
			private String removeLegacyAuthN;
			private String rewriteIndexHtml;
			private String rewritePositionTypeQueries;
			
			private String scoringAdditionalPolicies;
			private String scoringAdjust;
			private String scoringConfig;
			
			private String sessionIdleTime;
			private String smtpServer;
			private String snippetLength;
			private String startUrls;
			private String strictCookieComain;
			private String strictPasswordEnforcement;
			private String suggestBlacklist;
			private String suggestCollections;
			private String suggestKeywords;
			private String syslogServer;
			private String totalRecall;
			private String translationIntegration;
			private String trustConfig;
			
			private String uarEnableAuthN;
			private String uniLoginCustomisation;
			private String useDefaultBackOff;
			private String userAccounts;
			private String userAgent;
			
			private String wildcardCompleteIndexing;
			private String wildcardsEnabled;
			
			private String oneboxBackendConfig;
			private String oneboxConfig;
			private String certificateCount;
			
			private String customerOneboxConfigCount;
			
			public String getGoogleAppsDomain() {
				return googleAppsDomain;
			}
			public void setGoogleAppsDomain(String googleAppsDomain) {
				this.googleAppsDomain = googleAppsDomain;
			}
			public String getAclInheritance() {
				return aclInheritance;
			}
			public void setAclInheritance(String aclInheritance) {
				this.aclInheritance = aclInheritance;
			}
			public String getActiveLanguageBundle() {
				return activeLanguageBundle;
			}
			public void setActiveLanguageBundle(String activeLanguageBundle) {
				this.activeLanguageBundle = activeLanguageBundle;
			}
			public String getAdminConsoleAuthMode() {
				return adminConsoleAuthMode;
			}
			public void setAdminConsoleAuthMode(String adminConsoleAuthMode) {
				this.adminConsoleAuthMode = adminConsoleAuthMode;
			}
			public String getAdminHttpEnable() {
				return adminHttpEnable;
			}
			public void setAdminHttpEnable(String adminHttpEnable) {
				this.adminHttpEnable = adminHttpEnable;
			}
			public String getAlerts() {
				return alerts;
			}
			public void setAlerts(String alerts) {
				this.alerts = alerts;
			}
			public String getAlertFooterEmail() {
				return alertFooterEmail;
			}
			public void setAlertFooterEmail(String alertFooterEmail) {
				this.alertFooterEmail = alertFooterEmail;
			}
			public String getAlertHeaderEmail() {
				return alertHeaderEmail;
			}
			public void setAlertHeaderEmail(String alertHeaderEmail) {
				this.alertHeaderEmail = alertHeaderEmail;
			}
			public String getAuthDomains() {
				return authDomains;
			}
			public void setAuthDomains(String authDomains) {
				this.authDomains = authDomains;
			}
			public String getAuthClientCert() {
				return authClientCert;
			}
			public void setAuthClientCert(String authClientCert) {
				this.authClientCert = authClientCert;
			}
			public String getAuthOneBoxCert() {
				return authOneBoxCert;
			}
			public void setAuthOneBoxCert(String authOneBoxCert) {
				this.authOneBoxCert = authOneBoxCert;
			}
			public String getAuthServerCert() {
				return authServerCert;
			}
			public void setAuthServerCert(String authServerCert) {
				this.authServerCert = authServerCert;
			}
			public String getAuthnLoginUrl() {
				return authnLoginUrl;
			}
			public void setAuthnLoginUrl(String authnLoginUrl) {
				this.authnLoginUrl = authnLoginUrl;
			}
			public String getAuthnArtifactServiceUrl() {
				return authnArtifactServiceUrl;
			}
			public void setAuthnArtifactServiceUrl(String authnArtifactServiceUrl) {
				this.authnArtifactServiceUrl = authnArtifactServiceUrl;
			}
			public String getAuthzServiceUrl() {
				return authzServiceUrl;
			}
			public void setAuthzServiceUrl(String authzServiceUrl) {
				this.authzServiceUrl = authzServiceUrl;
			}
			public String getAutoComplete() {
				return autoComplete;
			}
			public void setAutoComplete(String autoComplete) {
				this.autoComplete = autoComplete;
			}
			public String getBackoffRemoveIndex() {
				return backoffRemoveIndex;
			}
			public void setBackoffRemoveIndex(String backoffRemoveIndex) {
				this.backoffRemoveIndex = backoffRemoveIndex;
			}
			public String getBadUrls() {
				return badUrls;
			}
			public void setBadUrls(String badUrls) {
				this.badUrls = badUrls;
			}
			public String getBasicAuthChallengeType() {
				return basicAuthChallengeType;
			}
			public void setBasicAuthChallengeType(String basicAuthChallengeType) {
				this.basicAuthChallengeType = basicAuthChallengeType;
			}
			public String getBatchCrawlMode() {
				return batchCrawlMode;
			}
			public void setBatchCrawlMode(String batchCrawlMode) {
				this.batchCrawlMode = batchCrawlMode;
			}
			public String getClickBoost() {
				return clickBoost;
			}
			public void setClickBoost(String clickBoost) {
				this.clickBoost = clickBoost;
			}
			public String getClickBoostData() {
				return clickBoostData;
			}
			public void setClickBoostData(String clickBoostData) {
				this.clickBoostData = clickBoostData;
			}
			public String getClickBoostSummaryData() {
				return clickBoostSummaryData;
			}
			public void setClickBoostSummaryData(String clickBoostSummaryData) {
				this.clickBoostSummaryData = clickBoostSummaryData;
			}
			public String getClickJackingDefense() {
				return clickJackingDefense;
			}
			public void setClickJackingDefense(String clickJackingDefense) {
				this.clickJackingDefense = clickJackingDefense;
			}
			public String getClickLogging() {
				return clickLogging;
			}
			public void setClickLogging(String clickLogging) {
				this.clickLogging = clickLogging;
			}
			public String getLowercaseUrls() {
				return lowercaseUrls;
			}
			public void setLowercaseUrls(String lowercaseUrls) {
				this.lowercaseUrls = lowercaseUrls;
			}
			public String getCookieDomain() {
				return cookieDomain;
			}
			public void setCookieDomain(String cookieDomain) {
				this.cookieDomain = cookieDomain;
			}
			public String getCoverageConfig() {
				return coverageConfig;
			}
			public void setCoverageConfig(String coverageConfig) {
				this.coverageConfig = coverageConfig;
			}
			public String getDefaultSearchUrl() {
				return defaultSearchUrl;
			}
			public void setDefaultSearchUrl(String defaultSearchUrl) {
				this.defaultSearchUrl = defaultSearchUrl;
			}
			public String getDelegatedAuthZ() {
				return delegatedAuthZ;
			}
			public void setDelegatedAuthZ(String delegatedAuthZ) {
				this.delegatedAuthZ = delegatedAuthZ;
			}
			public String getDenyRulesConfig() {
				return denyRulesConfig;
			}
			public void setDenyRulesConfig(String denyRulesConfig) {
				this.denyRulesConfig = denyRulesConfig;
			}
			public String getDisableInfiniteSpace() {
				return disableInfiniteSpace;
			}
			public void setDisableInfiniteSpace(String disableInfiniteSpace) {
				this.disableInfiniteSpace = disableInfiniteSpace;
			}
			public String getDisableLegacyAuthN() {
				return disableLegacyAuthN;
			}
			public void setDisableLegacyAuthN(String disableLegacyAuthN) {
				this.disableLegacyAuthN = disableLegacyAuthN;
			}
			public String getDnsOverride() {
				return dnsOverride;
			}
			public void setDnsOverride(String dnsOverride) {
				this.dnsOverride = dnsOverride;
			}
			public String getDoEntityExtraction() {
				return doEntityExtraction;
			}
			public void setDoEntityExtraction(String doEntityExtraction) {
				this.doEntityExtraction = doEntityExtraction;
			}
			public String getDocuMillDiskSizeLimit() {
				return docuMillDiskSizeLimit;
			}
			public void setDocuMillDiskSizeLimit(String docuMillDiskSizeLimit) {
				this.docuMillDiskSizeLimit = docuMillDiskSizeLimit;
			}
			public String getDocuMillDiskSizeBuffer() {
				return docuMillDiskSizeBuffer;
			}
			public void setDocuMillDiskSizeBuffer(String docuMillDiskSizeBuffer) {
				this.docuMillDiskSizeBuffer = docuMillDiskSizeBuffer;
			}
			public String getDocuMillMaxPages() {
				return docuMillMaxPages;
			}
			public void setDocuMillMaxPages(String docuMillMaxPages) {
				this.docuMillMaxPages = docuMillMaxPages;
			}
			public String getDocuMillNumThreads() {
				return docuMillNumThreads;
			}
			public void setDocuMillNumThreads(String docuMillNumThreads) {
				this.docuMillNumThreads = docuMillNumThreads;
			}
			public String getDocuMillResolution() {
				return docuMillResolution;
			}
			public void setDocuMillResolution(String docuMillResolution) {
				this.docuMillResolution = docuMillResolution;
			}
			public String getDupHosts() {
				return dupHosts;
			}
			public void setDupHosts(String dupHosts) {
				this.dupHosts = dupHosts;
			}
			public String getEnableCheckSuggestsExistInIndex() {
				return enableCheckSuggestsExistInIndex;
			}
			public void setEnableCheckSuggestsExistInIndex(String enableCheckSuggestsExistInIndex) {
				this.enableCheckSuggestsExistInIndex = enableCheckSuggestsExistInIndex;
			}
			public String getEnableContextSynsOneWordQueries() {
				return enableContextSynsOneWordQueries;
			}
			public void setEnableContextSynsOneWordQueries(String enableContextSynsOneWordQueries) {
				this.enableContextSynsOneWordQueries = enableContextSynsOneWordQueries;
			}
			public String getEnableTrustStore() {
				return enableTrustStore;
			}
			public void setEnableTrustStore(String enableTrustStore) {
				this.enableTrustStore = enableTrustStore;
			}
			public String getEnableDiacriticalEq() {
				return enableDiacriticalEq;
			}
			public void setEnableDiacriticalEq(String enableDiacriticalEq) {
				this.enableDiacriticalEq = enableDiacriticalEq;
			}
			public String getEnableDiacrititcsExpansion() {
				return enableDiacrititcsExpansion;
			}
			public void setEnableDiacrititcsExpansion(String enableDiacrititcsExpansion) {
				this.enableDiacrititcsExpansion = enableDiacrititcsExpansion;
			}
			public String getEnableDirtyWords() {
				return enableDirtyWords;
			}
			public void setEnableDirtyWords(String enableDirtyWords) {
				this.enableDirtyWords = enableDirtyWords;
			}
			public String getEnableDocuMill() {
				return enableDocuMill;
			}
			public void setEnableDocuMill(String enableDocuMill) {
				this.enableDocuMill = enableDocuMill;
			}
			public String getEnableInfiniteSpaceDetection() {
				return enableInfiniteSpaceDetection;
			}
			public void setEnableInfiniteSpaceDetection(String enableInfiniteSpaceDetection) {
				this.enableInfiniteSpaceDetection = enableInfiniteSpaceDetection;
			}
			public String getEnableKerberosCrawling() {
				return enableKerberosCrawling;
			}
			public void setEnableKerberosCrawling(String enableKerberosCrawling) {
				this.enableKerberosCrawling = enableKerberosCrawling;
			}
			public String getEnableLateBindingACL() {
				return enableLateBindingACL;
			}
			public void setEnableLateBindingACL(String enableLateBindingACL) {
				this.enableLateBindingACL = enableLateBindingACL;
			}
			public String getEnableLogManager() {
				return enableLogManager;
			}
			public void setEnableLogManager(String enableLogManager) {
				this.enableLogManager = enableLogManager;
			}
			public String getEnablePartialFieldsExpansion() {
				return enablePartialFieldsExpansion;
			}
			public void setEnablePartialFieldsExpansion(String enablePartialFieldsExpansion) {
				this.enablePartialFieldsExpansion = enablePartialFieldsExpansion;
			}
			public String getEnablePhraseSuggest() {
				return enablePhraseSuggest;
			}
			public void setEnablePhraseSuggest(String enablePhraseSuggest) {
				this.enablePhraseSuggest = enablePhraseSuggest;
			}
			public String getEnableQueryLogSuggest() {
				return enableQueryLogSuggest;
			}
			public void setEnableQueryLogSuggest(String enableQueryLogSuggest) {
				this.enableQueryLogSuggest = enableQueryLogSuggest;
			}
			public String getEnableSecureSearch() {
				return enableSecureSearch;
			}
			public void setEnableSecureSearch(String enableSecureSearch) {
				this.enableSecureSearch = enableSecureSearch;
			}
			public String getEnableSNMP() {
				return enableSNMP;
			}
			public void setEnableSNMP(String enableSNMP) {
				this.enableSNMP = enableSNMP;
			}
			public String getEnableUARSuggest() {
				return enableUARSuggest;
			}
			public void setEnableUARSuggest(String enableUARSuggest) {
				this.enableUARSuggest = enableUARSuggest;
			}
			public String getEnableFeedergateHttp() {
				return enableFeedergateHttp;
			}
			public void setEnableFeedergateHttp(String enableFeedergateHttp) {
				this.enableFeedergateHttp = enableFeedergateHttp;
			}
			public String getEnterpriseCrowdingConfig() {
				return enterpriseCrowdingConfig;
			}
			public void setEnterpriseCrowdingConfig(String enterpriseCrowdingConfig) {
				this.enterpriseCrowdingConfig = enterpriseCrowdingConfig;
			}
			public String getEntityDefinition() {
				return entityDefinition;
			}
			public void setEntityDefinition(String entityDefinition) {
				this.entityDefinition = entityDefinition;
			}
			public String getEntityDictionaryCount() {
				return entityDictionaryCount;
			}
			public void setEntityDictionaryCount(String entityDictionaryCount) {
				this.entityDictionaryCount = entityDictionaryCount;
			}
			public String getEntityDictionaryList() {
				return entityDictionaryList;
			}
			public void setEntityDictionaryList(String entityDictionaryList) {
				this.entityDictionaryList = entityDictionaryList;
			}
			public String getEntityGrammarsDefinition() {
				return entityGrammarsDefinition;
			}
			public void setEntityGrammarsDefinition(String entityGrammarsDefinition) {
				this.entityGrammarsDefinition = entityGrammarsDefinition;
			}
			public String getEntityMaxWords() {
				return entityMaxWords;
			}
			public void setEntityMaxWords(String entityMaxWords) {
				this.entityMaxWords = entityMaxWords;
			}
			public String getEntityPunctuationFile() {
				return entityPunctuationFile;
			}
			public void setEntityPunctuationFile(String entityPunctuationFile) {
				this.entityPunctuationFile = entityPunctuationFile;
			}
			public String getEntityPunctuationSpaceFile() {
				return entityPunctuationSpaceFile;
			}
			public void setEntityPunctuationSpaceFile(String entityPunctuationSpaceFile) {
				this.entityPunctuationSpaceFile = entityPunctuationSpaceFile;
			}
			public String getEntityBlacklist() {
				return entityBlacklist;
			}
			public void setEntityBlacklist(String entityBlacklist) {
				this.entityBlacklist = entityBlacklist;
			}
			public String getEscorerGaConfig() {
				return escorerGaConfig;
			}
			public void setEscorerGaConfig(String escorerGaConfig) {
				this.escorerGaConfig = escorerGaConfig;
			}
			public String getEstimatesInSecureSearches() {
				return estimatesInSecureSearches;
			}
			public void setEstimatesInSecureSearches(String estimatesInSecureSearches) {
				this.estimatesInSecureSearches = estimatesInSecureSearches;
			}
			public String getExpertSearchConfig() {
				return expertSearchConfig;
			}
			public void setExpertSearchConfig(String expertSearchConfig) {
				this.expertSearchConfig = expertSearchConfig;
			}
			public String getExternalSSH() {
				return externalSSH;
			}
			public void setExternalSSH(String externalSSH) {
				this.externalSSH = externalSSH;
			}
			public String getFederationConfig() {
				return federationConfig;
			}
			public void setFederationConfig(String federationConfig) {
				this.federationConfig = federationConfig;
			}
			public String getFederationEnabled() {
				return federationEnabled;
			}
			public void setFederationEnabled(String federationEnabled) {
				this.federationEnabled = federationEnabled;
			}
			public String getFederationUIEnabled() {
				return federationUIEnabled;
			}
			public void setFederationUIEnabled(String federationUIEnabled) {
				this.federationUIEnabled = federationUIEnabled;
			}
			public String getFeederConnectorManagerTrustedClients() {
				return feederConnectorManagerTrustedClients;
			}
			public void setFeederConnectorManagerTrustedClients(String feederConnectorManagerTrustedClients) {
				this.feederConnectorManagerTrustedClients = feederConnectorManagerTrustedClients;
			}
			public String getFeederTrustedClients() {
				return feederTrustedClients;
			}
			public void setFeederTrustedClients(String feederTrustedClients) {
				this.feederTrustedClients = feederTrustedClients;
			}
			public String getFooterEmail() {
				return footerEmail;
			}
			public void setFooterEmail(String footerEmail) {
				this.footerEmail = footerEmail;
			}
			public String getHeaderEmail() {
				return headerEmail;
			}
			public void setHeaderEmail(String headerEmail) {
				this.headerEmail = headerEmail;
			}
			public String getForceRecrawlUrls() {
				return forceRecrawlUrls;
			}
			public void setForceRecrawlUrls(String forceRecrawlUrls) {
				this.forceRecrawlUrls = forceRecrawlUrls;
			}
			public String getFrequentUrls() {
				return frequentUrls;
			}
			public void setFrequentUrls(String frequentUrls) {
				this.frequentUrls = frequentUrls;
			}
			public String getGoodUrls() {
				return goodUrls;
			}
			public void setGoodUrls(String goodUrls) {
				this.goodUrls = goodUrls;
			}
			public String getGoogleAppsUnificationEnabled() {
				return googleAppsUnificationEnabled;
			}
			public void setGoogleAppsUnificationEnabled(String googleAppsUnificationEnabled) {
				this.googleAppsUnificationEnabled = googleAppsUnificationEnabled;
			}
			public String getGsaEntityId() {
				return gsaEntityId;
			}
			public void setGsaEntityId(String gsaEntityId) {
				this.gsaEntityId = gsaEntityId;
			}
			public String getSamlMetadata() {
				return samlMetadata;
			}
			public void setSamlMetadata(String samlMetadata) {
				this.samlMetadata = samlMetadata;
			}
			public String getHttpHeaders() {
				return httpHeaders;
			}
			public void setHttpHeaders(String httpHeaders) {
				this.httpHeaders = httpHeaders;
			}
			public String getIgnoreAnchorsForSnippets() {
				return ignoreAnchorsForSnippets;
			}
			public void setIgnoreAnchorsForSnippets(String ignoreAnchorsForSnippets) {
				this.ignoreAnchorsForSnippets = ignoreAnchorsForSnippets;
			}
			public String getIndexServerDropDenyDecision() {
				return indexServerDropDenyDecision;
			}
			public void setIndexServerDropDenyDecision(String indexServerDropDenyDecision) {
				this.indexServerDropDenyDecision = indexServerDropDenyDecision;
			}
			public String getInfrequentUrls() {
				return infrequentUrls;
			}
			public void setInfrequentUrls(String infrequentUrls) {
				this.infrequentUrls = infrequentUrls;
			}
			public String getOutgoingSender() {
				return outgoingSender;
			}
			public void setOutgoingSender(String outgoingSender) {
				this.outgoingSender = outgoingSender;
			}
			public String getParametricConfigHasEntities() {
				return parametricConfigHasEntities;
			}
			public void setParametricConfigHasEntities(String parametricConfigHasEntities) {
				this.parametricConfigHasEntities = parametricConfigHasEntities;
			}
			public String getParametricSearchConfig() {
				return parametricSearchConfig;
			}
			public void setParametricSearchConfig(String parametricSearchConfig) {
				this.parametricSearchConfig = parametricSearchConfig;
			}
			public String getParametricSearchEnabled() {
				return parametricSearchEnabled;
			}
			public void setParametricSearchEnabled(String parametricSearchEnabled) {
				this.parametricSearchEnabled = parametricSearchEnabled;
			}
			public String getPeopleSearchConfig() {
				return peopleSearchConfig;
			}
			public void setPeopleSearchConfig(String peopleSearchConfig) {
				this.peopleSearchConfig = peopleSearchConfig;
			}
			public String getPeopleSearchMaxResults() {
				return peopleSearchMaxResults;
			}
			public void setPeopleSearchMaxResults(String peopleSearchMaxResults) {
				this.peopleSearchMaxResults = peopleSearchMaxResults;
			}
			public String getPerimeterSecurityEnabled() {
				return perimeterSecurityEnabled;
			}
			public void setPerimeterSecurityEnabled(String perimeterSecurityEnabled) {
				this.perimeterSecurityEnabled = perimeterSecurityEnabled;
			}
			public String getProblemEmail() {
				return problemEmail;
			}
			public void setProblemEmail(String problemEmail) {
				this.problemEmail = problemEmail;
			}
			public String getProxyConfig() {
				return proxyConfig;
			}
			public void setProxyConfig(String proxyConfig) {
				this.proxyConfig = proxyConfig;
			}
			public String getQueryExpStatus() {
				return queryExpStatus;
			}
			public void setQueryExpStatus(String queryExpStatus) {
				this.queryExpStatus = queryExpStatus;
			}
			public String getRedirectHttps() {
				return redirectHttps;
			}
			public void setRedirectHttps(String redirectHttps) {
				this.redirectHttps = redirectHttps;
			}
			public String getRemoteCollectionsConfig() {
				return remoteCollectionsConfig;
			}
			public void setRemoteCollectionsConfig(String remoteCollectionsConfig) {
				this.remoteCollectionsConfig = remoteCollectionsConfig;
			}
			public String getRemoteFrontendFilterEnabled() {
				return remoteFrontendFilterEnabled;
			}
			public void setRemoteFrontendFilterEnabled(String remoteFrontendFilterEnabled) {
				this.remoteFrontendFilterEnabled = remoteFrontendFilterEnabled;
			}
			public String getRemoveLegacyAuthN() {
				return removeLegacyAuthN;
			}
			public void setRemoveLegacyAuthN(String removeLegacyAuthN) {
				this.removeLegacyAuthN = removeLegacyAuthN;
			}
			public String getRewriteIndexHtml() {
				return rewriteIndexHtml;
			}
			public void setRewriteIndexHtml(String rewriteIndexHtml) {
				this.rewriteIndexHtml = rewriteIndexHtml;
			}
			public String getRewritePositionTypeQueries() {
				return rewritePositionTypeQueries;
			}
			public void setRewritePositionTypeQueries(String rewritePositionTypeQueries) {
				this.rewritePositionTypeQueries = rewritePositionTypeQueries;
			}
			public String getScoringAdditionalPolicies() {
				return scoringAdditionalPolicies;
			}
			public void setScoringAdditionalPolicies(String scoringAdditionalPolicies) {
				this.scoringAdditionalPolicies = scoringAdditionalPolicies;
			}
			public String getScoringAdjust() {
				return scoringAdjust;
			}
			public void setScoringAdjust(String scoringAdjust) {
				this.scoringAdjust = scoringAdjust;
			}
			public String getScoringConfig() {
				return scoringConfig;
			}
			public void setScoringConfig(String scoringConfig) {
				this.scoringConfig = scoringConfig;
			}
			public String getSessionIdleTime() {
				return sessionIdleTime;
			}
			public void setSessionIdleTime(String sessionIdleTime) {
				this.sessionIdleTime = sessionIdleTime;
			}
			public String getSmtpServer() {
				return smtpServer;
			}
			public void setSmtpServer(String smtpServer) {
				this.smtpServer = smtpServer;
			}
			public String getSnippetLength() {
				return snippetLength;
			}
			public void setSnippetLength(String snippetLength) {
				this.snippetLength = snippetLength;
			}
			public String getStartUrls() {
				return startUrls;
			}
			public void setStartUrls(String startUrls) {
				this.startUrls = startUrls;
			}
			public String getStrictCookieComain() {
				return strictCookieComain;
			}
			public void setStrictCookieComain(String strictCookieComain) {
				this.strictCookieComain = strictCookieComain;
			}
			public String getStrictPasswordEnforcement() {
				return strictPasswordEnforcement;
			}
			public void setStrictPasswordEnforcement(String strictPasswordEnforcement) {
				this.strictPasswordEnforcement = strictPasswordEnforcement;
			}
			public String getSuggestBlacklist() {
				return suggestBlacklist;
			}
			public void setSuggestBlacklist(String suggestBlacklist) {
				this.suggestBlacklist = suggestBlacklist;
			}
			public String getSuggestCollections() {
				return suggestCollections;
			}
			public void setSuggestCollections(String suggestCollections) {
				this.suggestCollections = suggestCollections;
			}
			public String getSuggestKeywords() {
				return suggestKeywords;
			}
			public void setSuggestKeywords(String suggestKeywords) {
				this.suggestKeywords = suggestKeywords;
			}
			public String getUniLoginCustomisation() {
				return uniLoginCustomisation;
			}
			public void setUniLoginCustomisation(String uniLoginCustomisation) {
				this.uniLoginCustomisation = uniLoginCustomisation;
			}
			public String getUseDefaultBackOff() {
				return useDefaultBackOff;
			}
			public void setUseDefaultBackOff(String useDefaultBackOff) {
				this.useDefaultBackOff = useDefaultBackOff;
			}
			public String getUserAgent() {
				return userAgent;
			}
			public void setUserAgent(String userAgent) {
				this.userAgent = userAgent;
			}
			public String getWildcardCompleteIndexing() {
				return wildcardCompleteIndexing;
			}
			public void setWildcardCompleteIndexing(String wildcardCompleteIndexing) {
				this.wildcardCompleteIndexing = wildcardCompleteIndexing;
			}
			public String getWildcardsEnabled() {
				return wildcardsEnabled;
			}
			public void setWildcardsEnabled(String wildcardsEnabled) {
				this.wildcardsEnabled = wildcardsEnabled;
			}
			public String getCertificateCount() {
				return certificateCount;
			}
			public void setCertificateCount(String count) {
				certificateCount = count;
			}
			public String getCustomerOneboxConfigCount() {
				return customerOneboxConfigCount;
			}
			public void setCustomerOneboxConfigCount(String count) {
				this.customerOneboxConfigCount = count;
			}
			public String getEnableFeedergateClientCerts() {
				return enableFeedergateClientCerts;
			}
			public void setEnableFeedergateClientCerts(String enableFeedergateClientCerts) {
				this.enableFeedergateClientCerts = enableFeedergateClientCerts;
			}
			public String getKmStart() {
				return kmStart;
			}
			public void setKmStart(String kmStart) {
				this.kmStart = kmStart;
			}
			public String getLdapConfig() {
				return ldapConfig;
			}
			public void setLdapConfig(String ldapConfig) {
				this.ldapConfig = ldapConfig;
			}
			public String getLdapManagerGroup() {
				return ldapManagerGroup;
			}
			public void setLdapManagerGroup(String ldapManagerGroup) {
				this.ldapManagerGroup = ldapManagerGroup;
			}
			public String getLdapSupervisorGroup() {
				return ldapSupervisorGroup;
			}
			public void setLdapSupervisorGroup(String ldapSupervisorGroup) {
				this.ldapSupervisorGroup = ldapSupervisorGroup;
			}
			public String getLdapSuperUserGroup() {
				return ldapSuperUserGroup;
			}
			public void setLdapSuperUserGroup(String ldapSuperUserGroup) {
				this.ldapSuperUserGroup = ldapSuperUserGroup;
			}
			public String getMultiBoxUIEnabled() {
				return multiBoxUIEnabled;
			}
			public void setMultiBoxUIEnabled(String multiBoxUIEnabled) {
				this.multiBoxUIEnabled = multiBoxUIEnabled;
			}
			public String getNotificationEmail() {
				return notificationEmail;
			}
			public void setNotificationEmail(String notificationEmail) {
				this.notificationEmail = notificationEmail;
			}
			public String getOnboardSecurityManagerEnabled() {
				return onboardSecurityManagerEnabled;
			}
			public void setOnboardSecurityManagerEnabled(String onboardSecurityManagerEnabled) {
				this.onboardSecurityManagerEnabled = onboardSecurityManagerEnabled;
			}
			public String getOneboxBackendConfig() {
				return oneboxBackendConfig;
			}
			public void setOneboxBackendConfig(String oneboxBackendConfig) {
				this.oneboxBackendConfig = oneboxBackendConfig;
			}
			public String getOneboxConfig() {
				return oneboxConfig;
			}
			public void setOneboxConfig(String oneboxConfig) {
				this.oneboxConfig = oneboxConfig;
			}
			public String getSyslogServer() {
				return syslogServer;
			}
			public void setSyslogServer(String syslogServer) {
				this.syslogServer = syslogServer;
			}
			public String getTotalRecall() {
				return totalRecall;
			}
			public void setTotalRecall(String totalRecall) {
				this.totalRecall = totalRecall;
			}
			public String getTranslationIntegration() {
				return translationIntegration;
			}
			public void setTranslationIntegration(String translationIntegration) {
				this.translationIntegration = translationIntegration;
			}
			public String getTrustConfig() {
				return trustConfig;
			}
			public void setTrustConfig(String trustConfig) {
				this.trustConfig = trustConfig;
			}
			public String getUarEnableAuthN() {
				return uarEnableAuthN;
			}
			public void setUarEnableAuthN(String uarEnableAuthN) {
				this.uarEnableAuthN = uarEnableAuthN;
			}
			public String getUserAccounts() {
				return userAccounts;
			}
			public void setUserAccounts(String userAccounts) {
				this.userAccounts = userAccounts;
			}
		}
		
		public static class GsaConfigComparator extends DefaultHandler {
			private List<GsaCollection> gcList = null;
			private List<GsaFrontEnd> feList = null;
			
			private String frontEndCount = null;
			private GsaCollection gsaCollection = null;
			private GsaFrontEnd gsaFrontEnd = null;
			private GsaGlobalParameters gsaGlobalParams = null;
			//entity booleans
			private Boolean badUrlEntity = null;
			private Boolean goodUrlEntity = null;
			private Boolean preReqResultEntiy = null;
			private Boolean testWordsEntity = null;
			private Boolean stylesheetEntity = null;
			private Boolean synonymEntity = null;
			private Boolean wcFilterEntity = null;
			private Boolean defaultLangEntity = null;
			private Boolean profileSheetEntity = null;
			private Boolean profileSheetEnEntity = null;
			private Boolean badUrlsNoReturnEntity = null;
			private Boolean domainFilterEntity = null;
			private Boolean fileTypeFilterEntity = null;
			private Boolean goodIPEntity = null;
			private Boolean googleMatchEntity = null;
			private Boolean langFilterEntity = null;
			private Boolean metatagFilterEntity = null;
			private Boolean queryExpansionFilterEntity = null;
			private Boolean queryExpansionMetaFilterEntity = null;
			private Boolean scoringPolicyFilterEntity = null;
			private Boolean starWildCardDefaultFilterEntity = null;
			private Boolean googleAppsDomainEntity = null;
			private Boolean aclInheritanceEntity = null;
			private Boolean activeLanguageBundleEntity = null;
			private Boolean adminConsoleAuthModeEntity = null;
			private Boolean adminHttpEnableEntity = null;
			private Boolean alertsEntity = null;
			private Boolean alertFooterEmailEntity = null;
			private Boolean alertHeaderEmailEntity = null;
			private Boolean authDomainsEntity = null;
			private Boolean authClientCertEntity = null;
			private Boolean authOneBoxCertEntity = null;
			private Boolean authServerCertEntity = null;
			private Boolean authnArtifactServiceUrlEntity = null;
			private Boolean authnLoginUrlEntity = null;
			private Boolean authzServiceUrlEntity = null;
			private Boolean autoCompleteEntity = null;
			private Boolean backoffRemoveIndexEntity = null;
			private Boolean badUrlsEntity = null;
			private Boolean basicAuthChallengeTypeEntity = null;
			private Boolean batchCrawlModeEntity = null;
			private Boolean clickBoostEntity = null;
			private Boolean clickBoostDataEntity = null;
			private Boolean clickBoostSummaryDataEntity = null;
			private Boolean clickJackingDefenseEntity = null;
			private Boolean clickLoggingEntity = null;
			private Boolean lowercaseUrlsEntity = null;
			private Boolean cookieDomainEntity = null;
			private Boolean coverageConfigEntity = null;
			private Boolean defaultSearchUrlEntity = null;
			private Boolean delegatedAuthZEntity = null;
			private Boolean denyRulesConfigEntity = null;
			private Boolean disableInfiniteSpaceEntity = null;
			private Boolean disableLegacyAuthNEntity = null;
			private Boolean dnsOverrideEntity = null;
			private Boolean doEntityExtractionEntity = null;
			private Boolean docuMillDiskSizeLimitEntity = null;
			private Boolean docuMillDiskSizeBufferEntity = null;
			private Boolean docuMillMaxPagesEntity = null;
			private Boolean docuMillNumThreadsEntity = null;
			private Boolean docuMillResolutionEntity = null;
			private Boolean dupHostsEntity = null;
			private Boolean enableCheckSuggestsExistInIndexEntity = null;
			private Boolean enableContextSynsOneWordQueriesEntity = null;
			private Boolean enableTrustStoreEntity = null;
			private Boolean enableDiacriticalEqEntity = null;
			private Boolean enableDiacrititcsExpansionEntity = null;
			private Boolean enableDirtyWordsEntity = null;
			private Boolean enableDocuMillEntity = null;
			private Boolean enableInfiniteSpaceDetectionEntity = null;
			private Boolean enableKerberosCrawlingEntity = null;
			private Boolean enableLateBindingACLEntity = null;
			private Boolean enableLogManagerEntity = null;
			private Boolean enablePartialFieldsExpansionEntity = null;
			private Boolean enablePhraseSuggestEntity = null;
			private Boolean enableQueryLogSuggestEntity = null;
			private Boolean enableSecureSearchEntity = null;
			private Boolean enableSNMPEntity = null;
			private Boolean enableUARSuggestEntity = null;
			private Boolean enableFeedergateClientCertsEntity = null;
			private Boolean enableFeedergateHttpEntity = null;
			private Boolean enterpriseCrowdingConfigEntity = null;
			private Boolean entityDefinitionEntity = null;
			private Boolean entityGrammarsDefinitionEntity = null;
			private Boolean entityMaxWordsEntity = null;
			private Boolean entityPunctuationFileEntity = null;
			private Boolean entityPunctuationSpaceFileEntity = null;
			private Boolean entityBlacklistEntity = null;
			private Boolean escorerGaConfigEntity = null;
			private Boolean estimatesInSecureSearchesEntity = null;
			private Boolean expertSearchConfigEntity = null;
			private Boolean externalSSHEntity = null;
			private Boolean federationConfigEntity = null;
			private Boolean federationEnabledEntity = null;
			private Boolean federationUIEnabledEntity = null;
			private Boolean feederConnectorManagerTrustedClientsEntity = null;
			private Boolean feederTrustedClientsEntity = null;
			private Boolean footerEmailEntity = null;
			private Boolean headerEmailEntity = null;
			private Boolean forceRecrawlUrlsEntity = null;
			private Boolean frequentUrlsEntity = null;
			private Boolean kmStartEntity = null;
			private Boolean ldapConfigEntity = null;
			private Boolean ldapManagerGroupEntity = null;
			private Boolean ldapSuperUserGroupEntity = null;
			private Boolean goodUrlsEntity = null;
			private Boolean googleAppsUnificationEnabledEntity = null;
			private Boolean gsaEntityIdEntity = null;
			private Boolean samlMetadataEntity = null;
			private Boolean httpHeadersEntity = null;
			private Boolean ignoreAnchorsForSnippetsEntity = null;
			private Boolean indexServerDropDenyDecisionEntity = null;
			private Boolean infrequentUrlsEntity = null;
			private Boolean outgoingSenderEntity = null;
			private Boolean multiBoxUIEnabledEntity = null;
			private Boolean notificationEmailEntity = null;
			private Boolean onboardSecurityManagerEnabledEntity = null;
			private Boolean parametricConfigHasEntitiesEntity = null;
			private Boolean parametricSearchConfigEntity = null;
			private Boolean parametricSearchEnabledEntity = null;
			private Boolean peopleSearchConfigEntity = null;
			private Boolean peopleSearchMaxResultsEntity = null;
			private Boolean perimeterSecurityEnabledEntity = null;
			private Boolean problemEmailEntity = null;
			private Boolean proxyConfigEntity = null;
			private Boolean queryExpStatusEntity = null;
			private Boolean redirectHttpsEntity = null;
			private Boolean remoteCollectionsConfigEntity = null;
			private Boolean remoteFrontendFilterEnabledEntity = null;
			private Boolean removeLegacyAuthNEntity = null;
			private Boolean rewriteIndexHtmlEntity = null;
			private Boolean rewritePositionTypeQueriesEntity = null;
			private Boolean scoringAdditionalPoliciesEntity = null;
			private Boolean scoringAdjustEntity = null;
			private Boolean scoringConfigEntity = null;
			private Boolean sessionIdleTimeEntity = null;
			private Boolean smtpServerEntity = null;
			private Boolean snippetLengthEntity = null;
			private Boolean startUrlsEntity = null;
			private Boolean strictCookieComainEntity = null;
			private Boolean strictPasswordEnforcementEntity = null;
			private Boolean suggestBlacklistEntity = null;
			private Boolean suggestCollectionsEntity = null;
			private Boolean suggestKeywordsEntity = null;
			private Boolean syslogServerEntity = null;
			private Boolean totalRecallEntity = null;
			private Boolean translationIntegrationEntity = null;
			private Boolean trustConfigEntity = null;
			private Boolean uarEnableAuthNEntity = null;
			private Boolean uniLoginCustomisationEntity = null;
			private Boolean useDefaultBackOffEntity = null;
			private Boolean userAccountsEntity = null;
			private Boolean userAgentEntity = null;
			private Boolean wildcardCompleteIndexingEntity = null;
			private Boolean wildcardsEnabledEntity = null;
			private Boolean oneboxBackendConfigEntity = null;
			private Boolean oneboxConfigEntity = null;
			
			public List<GsaCollection> getGsaCollections() {
				  return this.gcList;
			}
			public String getFrontEndCount() {
				return frontEndCount;
			}

			public void setFrontEndCount(String frontEndCount) {
				this.frontEndCount = frontEndCount;
			}
			
			@Override
			public void startElement(String uri, String localName, String qName, Attributes attributes) throws SAXException {
				//collections
				if (qName.equalsIgnoreCase("collection")) {
					String name = attributes.getValue("Name");
					gsaCollection = new GsaCollection();
					gsaCollection.setName(name);
				
					if (gcList == null) {
						gcList = new ArrayList<>();
					}
				} else if (qName.equalsIgnoreCase("frontends")) {
					setFrontEndCount(attributes.getValue("Count"));
				} else if (qName.equalsIgnoreCase("frontend")) {
					String name = attributes.getValue("Name");
					gsaFrontEnd = new GsaFrontEnd();
					gsaFrontEnd.setName(name);
					if (feList == null) {
						feList = new ArrayList<>();
					}
				} else if (qName.equalsIgnoreCase("globalparams")) {
					gsaGlobalParams = new GsaGlobalParameters();
				}
				
				if (gsaCollection != null) {
					
					if (qName.equalsIgnoreCase("bad_urls")) { 
						badUrlEntity = true;
					} else if (qName.equalsIgnoreCase("good_urls")) { 
						goodUrlEntity = true;
					} else if (qName.equalsIgnoreCase("prerequisite_results")) { 
						preReqResultEntiy = true;
					} else if (qName.equalsIgnoreCase("testwords")) { 
						testWordsEntity = true;
					}
					
				}
			 
				
				if (gsaFrontEnd != null) {
					
					if (qName.equalsIgnoreCase("stylesheet")) {
						stylesheetEntity = true;					
					} else if (qName.equalsIgnoreCase("synonyms")) {
						synonymEntity = true;					
					}  else if (qName.equalsIgnoreCase("wildcard_wc_filter")) {
						wcFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("default_language")) {
						defaultLangEntity = true;					
					} else if (qName.equalsIgnoreCase("profile_sheet")) {
						profileSheetEntity = true;					
					} else if (qName.equalsIgnoreCase("profile_sheet.en")) {
						profileSheetEnEntity = true;					
					} else if (qName.equalsIgnoreCase("badurls_noreturn")) {
						badUrlsNoReturnEntity = true;					
					} else if (qName.equalsIgnoreCase("domain_filter")) {
						domainFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("filetype_filter")) {
						fileTypeFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("good_ips")) {
						goodIPEntity = true;					
					} else if (qName.equalsIgnoreCase("googlematch")) {
						googleMatchEntity = true;					
					} else if (qName.equalsIgnoreCase("lang_filter")) {
						langFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("metatag_filter")) {
						metatagFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("query_expansion_filter")) {
						queryExpansionFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("query_expansion_meta_filter")) {
						queryExpansionMetaFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("scoring_policy_filter")) {
						scoringPolicyFilterEntity = true;					
					} else if (qName.equalsIgnoreCase("star_wildcard_default_filter")) {
						starWildCardDefaultFilterEntity = true;					
					}
					
				}
				
				if (gsaGlobalParams != null) {
					if (qName.equalsIgnoreCase("_google_apps_domain")) {
						 googleAppsDomainEntity = true;
						} else if (qName.equalsIgnoreCase("acl_inheritance_ser_ascii")) {
						 aclInheritanceEntity = true;
						} else if (qName.equalsIgnoreCase("active_language_bundle")) {
						 activeLanguageBundleEntity = true;
						} else if (qName.equalsIgnoreCase("admin_console_auth_mode")) {
						 adminConsoleAuthModeEntity = true;
						} else if (qName.equalsIgnoreCase("admin_http_enable")) {
						 adminHttpEnableEntity = true;
						} else if (qName.equalsIgnoreCase("alerts2")) {
						 alertsEntity = true;
						} else if (qName.equalsIgnoreCase("alerts_footer_email")) {
						 alertFooterEmailEntity = true;
						} else if (qName.equalsIgnoreCase("alerts_header_email")) {
						 alertHeaderEmailEntity = true;
						} else if (qName.equalsIgnoreCase("auth_domains")) {
						 authDomainsEntity = true;
						} else if (qName.equalsIgnoreCase("authenticate_client_cert")) {
						 authClientCertEntity = true;
						} else if (qName.equalsIgnoreCase("authenticate_onebox_server_cert")) {
						 authOneBoxCertEntity = true;
						} else if (qName.equalsIgnoreCase("authenticate_server_cert")) {
						 authServerCertEntity = true;
						} else if (qName.equalsIgnoreCase("authn_artifact_service_url")) {
						 authnArtifactServiceUrlEntity = true;
						} else if (qName.equalsIgnoreCase("authn_login_Url")) {
						 authnLoginUrlEntity = true;
						} else if (qName.equalsIgnoreCase("authz_service_url")) {
						 authzServiceUrlEntity = true;
						} else if (qName.equalsIgnoreCase("autocomplete_off")) {
						 autoCompleteEntity = true;
						} else if (qName.equalsIgnoreCase("backoff_remove_index_info")) {
						 backoffRemoveIndexEntity = true;
						} else if (qName.equalsIgnoreCase("bad_urls")) {
						 badUrlsEntity = true;
						} else if (qName.equalsIgnoreCase("basic_auth_challenge_tpye")) {
						 basicAuthChallengeTypeEntity = true;
						} else if (qName.equalsIgnoreCase("batch_crawl_mode")) {
						 batchCrawlModeEntity = true;
						} else if (qName.equalsIgnoreCase("certificates")) {
							String count = attributes.getValue("Count");
							gsaGlobalParams.setCertificateCount(count);
						} else if (qName.equalsIgnoreCase("clickboost")) {
						 clickBoostEntity = true;
						} else if (qName.equalsIgnoreCase("clickboost_data")) {
						 clickBoostDataEntity = true;
						} else if (qName.equalsIgnoreCase("clickboost_summary_data")) {
						 clickBoostSummaryDataEntity = true;
						} else if (qName.equalsIgnoreCase("clickjacking_defense")) {
						 clickJackingDefenseEntity = true;
						} else if (qName.equalsIgnoreCase("clicklogging")) {
						 clickLoggingEntity = true;
						} else if (qName.equalsIgnoreCase("convert_to_lowercase_urls")) {
						 lowercaseUrlsEntity = true;
						} else if (qName.equalsIgnoreCase("cookie_domain")) {
						 cookieDomainEntity = true;
						} else if (qName.equalsIgnoreCase("coverage_config")) {
						 coverageConfigEntity = true;
						} else if (qName.equalsIgnoreCase("customer_onebox_config")) {
							String count = attributes.getValue("Count");
							gsaGlobalParams.setCustomerOneboxConfigCount(count);
						} else if (qName.equalsIgnoreCase("default_search_url")) {
						 defaultSearchUrlEntity = true;
						} else if (qName.equalsIgnoreCase("delegated_authz_enabled")) {
						 delegatedAuthZEntity = true;
						} else if (qName.equalsIgnoreCase("deny_rules_config")) {
						 denyRulesConfigEntity = true;
						} else if (qName.equalsIgnoreCase("disable_infinitespace_check")) {
						 disableInfiniteSpaceEntity = true;
						} else if (qName.equalsIgnoreCase("disable_legacy_authn")) {
						 disableLegacyAuthNEntity = true;
						} else if (qName.equalsIgnoreCase("dns_override")) {
						 dnsOverrideEntity = true;
						} else if (qName.equalsIgnoreCase("do_entity_extraction")) {
						 doEntityExtractionEntity = true;
						} else if (qName.equalsIgnoreCase("documill_disk_size_buffer_percentage")) {
						 docuMillDiskSizeBufferEntity = true;
						} else if (qName.equalsIgnoreCase("documill_disk_size_limit")) {
						 docuMillDiskSizeLimitEntity = true;
						} else if (qName.equalsIgnoreCase("documill_max_pages")) {
						 docuMillMaxPagesEntity = true;
						} else if (qName.equalsIgnoreCase("documill_num_threads")) {
						 docuMillNumThreadsEntity = true;
						} else if (qName.equalsIgnoreCase("documill_resolution")) {
						 docuMillResolutionEntity = true;
						} else if (qName.equalsIgnoreCase("dup_hosts")) {
						 dupHostsEntity = true;
						} else if (qName.equalsIgnoreCase("enable_check_suggests_exist_in_index")) {
						 enableCheckSuggestsExistInIndexEntity = true;
						} else if (qName.equalsIgnoreCase("enable_context_syns_for_one_word_queries")) {
						 enableContextSynsOneWordQueriesEntity = true;
						} else if (qName.equalsIgnoreCase("enable_default_truststore")) {
						 enableTrustStoreEntity = true;
						} else if (qName.equalsIgnoreCase("enable_diacritical_eq")) {
						 enableDiacriticalEqEntity = true;
						} else if (qName.equalsIgnoreCase("enable_diacrititcs_expansion_in_meta_tag_values")) {
						 enableDiacrititcsExpansionEntity = true;
						} else if (qName.equalsIgnoreCase("enable_dirty_words")) {
						 enableDirtyWordsEntity = true;
						} else if (qName.equalsIgnoreCase("enable_documill")) {
						 enableDocuMillEntity = true;
						} else if (qName.equalsIgnoreCase("enable_infinite_space_detection")) {
						 enableInfiniteSpaceDetectionEntity = true;
						} else if (qName.equalsIgnoreCase("enable_kerberos_crawling")) {
						 enableKerberosCrawlingEntity = true;
						} else if (qName.equalsIgnoreCase("enable_late_binding_acl")) {
						 enableLateBindingACLEntity = true;
						} else if (qName.equalsIgnoreCase("enable_log_manager")) {
						 enableLogManagerEntity = true;
						} else if (qName.equalsIgnoreCase("enable_partialfields_expansion")) {
						 enablePartialFieldsExpansionEntity = true;
						} else if (qName.equalsIgnoreCase("enable_phrase_suggest")) {
						 enablePhraseSuggestEntity = true;
						} else if (qName.equalsIgnoreCase("enable_query_log_suggest")) {
						 enableQueryLogSuggestEntity = true;
						} else if (qName.equalsIgnoreCase("enable_secure_search_api")) {
						 enableSecureSearchEntity = true;
						} else if (qName.equalsIgnoreCase("enable_snmp")) {
						 enableSNMPEntity = true;
						} else if (qName.equalsIgnoreCase("enable_uar_suggest")) {
						 enableUARSuggestEntity = true;
						} else if (qName.equalsIgnoreCase("ent_enable_feedergate_client_certs")) {
						 enableFeedergateClientCertsEntity = true;
						} else if (qName.equalsIgnoreCase("ent_enable_feedergate_http")) {
						 enableFeedergateHttpEntity = true;
						} else if (qName.equalsIgnoreCase("enterprise_crowding_config_file")) {
						 enterpriseCrowdingConfigEntity = true;
						} else if (qName.equalsIgnoreCase("entity_definition")) {
						 entityDefinitionEntity = true;
						} else if (qName.equalsIgnoreCase("entity_dictionaries")) {
							String count = attributes.getValue("Count");
							gsaGlobalParams.setEntityDictionaryCount(count);
						} else if (qName.equalsIgnoreCase("entity_grammars_definition")) {
						 entityGrammarsDefinitionEntity = true;
						} else if (qName.equalsIgnoreCase("entity_max_words_window")) {
						 entityMaxWordsEntity = true;
						} else if (qName.equalsIgnoreCase("entity_punctuation_marks_file")) {
						 entityPunctuationFileEntity = true;
						} else if (qName.equalsIgnoreCase("entity_punctuation_marks_if_next_to_space_file")) {
						 entityPunctuationSpaceFileEntity = true;
						} else if (qName.equalsIgnoreCase("entity_terms_blacklist")) {
						 entityBlacklistEntity = true;
						} else if (qName.equalsIgnoreCase("escorer_training_ga_config_file")) {
						 escorerGaConfigEntity = true;
						} else if (qName.equalsIgnoreCase("estimates_in_secure_searches")) {
						 estimatesInSecureSearchesEntity = true;
						} else if (qName.equalsIgnoreCase("expert_search_config")) {
						 expertSearchConfigEntity = true;
						} else if (qName.equalsIgnoreCase("external_ssh")) {
						 externalSSHEntity = true;
						} else if (qName.equalsIgnoreCase("federation_config")) {
						 federationConfigEntity = true;
						} else if (qName.equalsIgnoreCase("federation_enabled")) {
						 federationEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("federation_ui_enabled")) {
						 federationUIEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("feeder_connector_manager_trusted_clients")) {
						 feederConnectorManagerTrustedClientsEntity = true;
						} else if (qName.equalsIgnoreCase("feeder_trusted_clients")) {
						 feederTrustedClientsEntity = true;
						} else if (qName.equalsIgnoreCase("footer_email")) {
						 footerEmailEntity = true;
						} else if (qName.equalsIgnoreCase("force_recrawl_urls")) {
						 forceRecrawlUrlsEntity = true;
						} else if (qName.equalsIgnoreCase("frequent_urls")) {
						 frequentUrlsEntity = true;
						} else if (qName.equalsIgnoreCase("good_urls")) {
						 goodUrlsEntity = true;
						} else if (qName.equalsIgnoreCase("google_apps_unification_enabled")) {
						 googleAppsUnificationEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("gsa_entity_id")) {
						 gsaEntityIdEntity = true;
						} else if (qName.equalsIgnoreCase("header_email")) {
						 headerEmailEntity = true;
						} else if (qName.equalsIgnoreCase("http_headers")) {
						 httpHeadersEntity = true;
						} else if (qName.equalsIgnoreCase("ignore_anchors_for_snippets")) {
						 ignoreAnchorsForSnippetsEntity = true;
						} else if (qName.equalsIgnoreCase("indexserver_drop_deny_decisions")) {
						 indexServerDropDenyDecisionEntity = true;
						} else if (qName.equalsIgnoreCase("infrequent_urls")) {
						 infrequentUrlsEntity = true;
						} else if (qName.equalsIgnoreCase("km_start")) {
						 kmStartEntity = true;
						} else if (qName.equalsIgnoreCase("ldap_config")) {
						 ldapConfigEntity = true;
						} else if (qName.equalsIgnoreCase("ldap_manager_group")) {
						 ldapManagerGroupEntity = true;
						} else if (qName.equalsIgnoreCase("ldap_superuser_group")) {
						 ldapSuperUserGroupEntity = true;
						} else if (qName.equalsIgnoreCase("multibox_ui_enabled")) {
						 multiBoxUIEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("notification_email")) {
						 notificationEmailEntity = true;
						} else if (qName.equalsIgnoreCase("onboard_security_manager_enabled")) {
						 onboardSecurityManagerEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("onebox_backend_config")) {
						 oneboxBackendConfigEntity = true;
						} else if (qName.equalsIgnoreCase("onebox_config")) {
						 oneboxConfigEntity = true;
						} else if (qName.equalsIgnoreCase("outgoing_sender")) {
						 outgoingSenderEntity = true;
						} else if (qName.equalsIgnoreCase("parametric_config_has_entities")) {
						 parametricConfigHasEntitiesEntity = true;
						} else if (qName.equalsIgnoreCase("parametric_search_config")) {
						 parametricSearchConfigEntity = true;
						} else if (qName.equalsIgnoreCase("parametric_search_enabled")) {
						 parametricSearchEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("people_search_config")) {
						 peopleSearchConfigEntity = true;
						} else if (qName.equalsIgnoreCase("people_search_maximum_search_results")) {
						 peopleSearchMaxResultsEntity = true;
						} else if (qName.equalsIgnoreCase("perimeter_security_enabled")) {
						 perimeterSecurityEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("problem_email")) {
						 problemEmailEntity = true;
						} else if (qName.equalsIgnoreCase("proxy_config")) {
						 proxyConfigEntity = true;
						} else if (qName.equalsIgnoreCase("query_exp_status")) {
						 queryExpStatusEntity = true;
						} else if (qName.equalsIgnoreCase("redirect_https")) {
						 redirectHttpsEntity = true;
						} else if (qName.equalsIgnoreCase("remote_collections_cfg")) {
						 remoteCollectionsConfigEntity = true;
						} else if (qName.equalsIgnoreCase("remote_frontend_filter_enabled")) {
						 remoteFrontendFilterEnabledEntity = true;
						} else if (qName.equalsIgnoreCase("remove_legacy_authn")) {
						 removeLegacyAuthNEntity = true;
						} else if (qName.equalsIgnoreCase("rewrite_index_html")) {
						 rewriteIndexHtmlEntity = true;
						} else if (qName.equalsIgnoreCase("rewrite_position_type_queries")) {
						 rewritePositionTypeQueriesEntity = true;
						} else if (qName.equalsIgnoreCase("saml_metadata")) {
						 samlMetadataEntity = true;
						} else if (qName.equalsIgnoreCase("scoring_additional_policies")) {
						 scoringAdditionalPoliciesEntity = true;
						} else if (qName.equalsIgnoreCase("scoring_adjust")) {
						 scoringAdjustEntity = true;
						} else if (qName.equalsIgnoreCase("scoring_config")) {
						 scoringConfigEntity = true;
						} else if (qName.equalsIgnoreCase("session_idle_time")) {
						 sessionIdleTimeEntity = true;
						} else if (qName.equalsIgnoreCase("smtp_server")) {
						 smtpServerEntity = true;
						} else if (qName.equalsIgnoreCase("snippet_length")) {
						 snippetLengthEntity = true;
						} else if (qName.equalsIgnoreCase("start_urls")) {
						 startUrlsEntity = true;
						} else if (qName.equalsIgnoreCase("strict_cookie_domain_check")) {
						 strictCookieComainEntity = true;
						} else if (qName.equalsIgnoreCase("strict_password_enforcement")) {
						 strictPasswordEnforcementEntity = true;
						} else if (qName.equalsIgnoreCase("suggest_blacklist")) {
						 suggestBlacklistEntity = true;
						} else if (qName.equalsIgnoreCase("suggest_collections")) {
						 suggestCollectionsEntity = true;
						} else if (qName.equalsIgnoreCase("suggest_keywords")) {
						 suggestKeywordsEntity = true;
						} else if (qName.equalsIgnoreCase("syslog_server")) {
						 syslogServerEntity = true;
						} else if (qName.equalsIgnoreCase("total_recall")) {
						 totalRecallEntity = true;
						} else if (qName.equalsIgnoreCase("translation_integration")) {
						 translationIntegrationEntity = true;
						} else if (qName.equalsIgnoreCase("trust_config")) {
						 trustConfigEntity = true;
						} else if (qName.equalsIgnoreCase("uar_enable_authn")) {
						 uarEnableAuthNEntity = true;
						} else if (qName.equalsIgnoreCase("uni_login_customization")) {
						 uniLoginCustomisationEntity = true;
						} else if (qName.equalsIgnoreCase("use_default_backoffs_removals")) {
						 useDefaultBackOffEntity = true;
						} else if (qName.equalsIgnoreCase("user_accounts")) {
						 userAccountsEntity = true;
						} else if (qName.equalsIgnoreCase("user_agent")) {
						 userAgentEntity = true;
						} else if (qName.equalsIgnoreCase("wildcards_complete_indexing")) {
						 wildcardCompleteIndexingEntity = true;
						} else if (qName.equalsIgnoreCase("wildcards_enable")) {
						 wildcardsEnabledEntity = true;
						}

				}

			}
			
			@Override
			public void characters(char[] ch, int start, int length) throws SAXException {
				if (badUrlEntity) {
					gsaCollection.setBadUrls(ch.toString());
				} else if (goodUrlEntity) {
					gsaCollection.setGoodUrls(ch.toString());
				} else if (preReqResultEntiy) {
					gsaCollection.setPreReqResults(ch.toString());
				} else if (testWordsEntity) {
					gsaCollection.setTestWords(ch.toString());
				} else if (synonymEntity) {
					gsaFrontEnd.setSynonyms(ch.toString());
				} else if (wcFilterEntity) {
					gsaFrontEnd.setWildCardWCFilter(ch.toString());
				} else if (defaultLangEntity) {
					gsaFrontEnd.setDefaultLanguage(ch.toString());
				} else if (profileSheetEntity) {
					gsaFrontEnd.setProfileSheet(ch.toString());
				} else if (profileSheetEnEntity) {
					gsaFrontEnd.setProfileSheetEn(ch.toString());
				} else if (badUrlsNoReturnEntity) {
					gsaFrontEnd.setBadUrlsNoReturn(ch.toString());
				} else if (domainFilterEntity) {
					gsaFrontEnd.setDomainFilter(ch.toString());
				} else if (fileTypeFilterEntity) {
					gsaFrontEnd.setFileTypeFilter(ch.toString());
				} else if (goodIPEntity) {
					gsaFrontEnd.setGoodIPs(ch.toString());
				} else if (googleMatchEntity) {
					gsaFrontEnd.setGoogleMatch(ch.toString());
				} else if (langFilterEntity) {
					gsaFrontEnd.setLangFilter(ch.toString());
				} else if (metatagFilterEntity) {
					gsaFrontEnd.setMetatagFilter(ch.toString());
				} else if (queryExpansionFilterEntity) {
					gsaFrontEnd.setQueryExpansionFilter(ch.toString());
				} else if (queryExpansionMetaFilterEntity) {
					gsaFrontEnd.setQueryExpansionMetaFilter(ch.toString());
				} else if (scoringPolicyFilterEntity) {
					gsaFrontEnd.setScoringPolicyFilter(ch.toString());
				} else if (starWildCardDefaultFilterEntity) {
					gsaFrontEnd.setStarWildCardDefaultFilter(ch.toString());
				} else if (stylesheetEntity) {
					gsaFrontEnd.setStyleSheet(ch.toString());
				} else if(googleAppsDomainEntity) {
				  gsaGlobalParams.setGoogleAppsDomain(ch.toString());
				} else if(aclInheritanceEntity) {
				  gsaGlobalParams.setAclInheritance(ch.toString());
				} else if(activeLanguageBundleEntity) {
				  gsaGlobalParams.setActiveLanguageBundle(ch.toString());
				} else if(adminConsoleAuthModeEntity) {
				  gsaGlobalParams.setAdminConsoleAuthMode(ch.toString());
				} else if(adminHttpEnableEntity) {
				  gsaGlobalParams.setAdminHttpEnable(ch.toString());
				} else if(alertsEntity) {
				  gsaGlobalParams.setAlerts(ch.toString());
				} else if(alertFooterEmailEntity) {
				  gsaGlobalParams.setAlertFooterEmail(ch.toString());
				} else if(alertHeaderEmailEntity) {
				  gsaGlobalParams.setAlertHeaderEmail(ch.toString());
				} else if(authDomainsEntity) {
				  gsaGlobalParams.setAuthDomains(ch.toString());
				} else if(authClientCertEntity) {
				  gsaGlobalParams.setAuthClientCert(ch.toString());
				} else if(authOneBoxCertEntity) {
				  gsaGlobalParams.setAuthOneBoxCert(ch.toString());
				} else if(authServerCertEntity) {
				  gsaGlobalParams.setAuthServerCert(ch.toString());
				} else if(authnArtifactServiceUrlEntity) {
				  gsaGlobalParams.setAuthnArtifactServiceUrl(ch.toString());
				} else if(authnLoginUrlEntity) {
				  gsaGlobalParams.setAuthnLoginUrl(ch.toString());
				} else if(authzServiceUrlEntity) {
				  gsaGlobalParams.setAuthzServiceUrl(ch.toString());
				} else if(autoCompleteEntity) {
				  gsaGlobalParams.setAutoComplete(ch.toString());
				} else if(backoffRemoveIndexEntity) {
				  gsaGlobalParams.setBackoffRemoveIndex(ch.toString());
				} else if(badUrlsEntity) {
				  gsaGlobalParams.setBadUrls(ch.toString());
				} else if(basicAuthChallengeTypeEntity) {
				  gsaGlobalParams.setBasicAuthChallengeType(ch.toString());
				} else if(batchCrawlModeEntity) {
				  gsaGlobalParams.setBatchCrawlMode(ch.toString());
				} else if(clickBoostEntity) {
				  gsaGlobalParams.setClickBoost(ch.toString());
				} else if(clickBoostDataEntity) {
				  gsaGlobalParams.setClickBoostData(ch.toString());
				} else if(clickBoostSummaryDataEntity) {
				  gsaGlobalParams.setClickBoostSummaryData(ch.toString());
				} else if(clickJackingDefenseEntity) {
				  gsaGlobalParams.setClickJackingDefense(ch.toString());
				} else if(clickLoggingEntity) {
				  gsaGlobalParams.setClickLogging(ch.toString());
				} else if(lowercaseUrlsEntity) {
				  gsaGlobalParams.setLowercaseUrls(ch.toString());
				} else if(cookieDomainEntity) {
				  gsaGlobalParams.setCookieDomain(ch.toString());
				} else if(coverageConfigEntity) {
				  gsaGlobalParams.setCoverageConfig(ch.toString());
				} else if(defaultSearchUrlEntity) {
				  gsaGlobalParams.setDefaultSearchUrl(ch.toString());
				} else if(delegatedAuthZEntity) {
				  gsaGlobalParams.setDelegatedAuthZ(ch.toString());
				} else if(denyRulesConfigEntity) {
				  gsaGlobalParams.setDenyRulesConfig(ch.toString());
				} else if(disableInfiniteSpaceEntity) {
				  gsaGlobalParams.setDisableInfiniteSpace(ch.toString());
				} else if(disableLegacyAuthNEntity) {
				  gsaGlobalParams.setDisableLegacyAuthN(ch.toString());
				} else if(dnsOverrideEntity) {
				  gsaGlobalParams.setDnsOverride(ch.toString());
				} else if(doEntityExtractionEntity) {
				  gsaGlobalParams.setDoEntityExtraction(ch.toString());
				} else if(docuMillDiskSizeBufferEntity) {
				  gsaGlobalParams.setDocuMillDiskSizeBuffer(ch.toString());
				} else if(docuMillDiskSizeLimitEntity) {
				  gsaGlobalParams.setDocuMillDiskSizeLimit(ch.toString());
				} else if(docuMillMaxPagesEntity) {
				  gsaGlobalParams.setDocuMillMaxPages(ch.toString());
				} else if(docuMillNumThreadsEntity) {
				  gsaGlobalParams.setDocuMillNumThreads(ch.toString());
				} else if(docuMillResolutionEntity) {
				  gsaGlobalParams.setDocuMillResolution(ch.toString());
				} else if(dupHostsEntity) {
				  gsaGlobalParams.setDupHosts(ch.toString());
				} else if(enableCheckSuggestsExistInIndexEntity) {
				  gsaGlobalParams.setEnableCheckSuggestsExistInIndex(ch.toString());
				} else if(enableContextSynsOneWordQueriesEntity) {
				  gsaGlobalParams.setEnableContextSynsOneWordQueries(ch.toString());
				} else if(enableTrustStoreEntity) {
				  gsaGlobalParams.setEnableTrustStore(ch.toString());
				} else if(enableDiacriticalEqEntity) {
				  gsaGlobalParams.setEnableDiacriticalEq(ch.toString());
				} else if(enableDiacrititcsExpansionEntity) {
				  gsaGlobalParams.setEnableDiacrititcsExpansion(ch.toString());
				} else if(enableDirtyWordsEntity) {
				  gsaGlobalParams.setEnableDirtyWords(ch.toString());
				} else if(enableDocuMillEntity) {
				  gsaGlobalParams.setEnableDocuMill(ch.toString());
				} else if(enableInfiniteSpaceDetectionEntity) {
				  gsaGlobalParams.setEnableInfiniteSpaceDetection(ch.toString());
				} else if(enableKerberosCrawlingEntity) {
				  gsaGlobalParams.setEnableKerberosCrawling(ch.toString());
				} else if(enableLateBindingACLEntity) {
				  gsaGlobalParams.setEnableLateBindingACL(ch.toString());
				} else if(enableLogManagerEntity) {
				  gsaGlobalParams.setEnableLogManager(ch.toString());
				} else if(enablePartialFieldsExpansionEntity) {
				  gsaGlobalParams.setEnablePartialFieldsExpansion(ch.toString());
				} else if(enablePhraseSuggestEntity) {
				  gsaGlobalParams.setEnablePhraseSuggest(ch.toString());
				} else if(enableQueryLogSuggestEntity) {
				  gsaGlobalParams.setEnableQueryLogSuggest(ch.toString());
				} else if(enableSecureSearchEntity) {
				  gsaGlobalParams.setEnableSecureSearch(ch.toString());
				} else if(enableSNMPEntity) {
				  gsaGlobalParams.setEnableSNMP(ch.toString());
				} else if(enableUARSuggestEntity) {
				  gsaGlobalParams.setEnableUARSuggest(ch.toString());
				} else if(enableFeedergateClientCertsEntity) {
				  gsaGlobalParams.setEnableFeedergateClientCerts(ch.toString());
				} else if(enableFeedergateHttpEntity) {
				  gsaGlobalParams.setEnableFeedergateHttp(ch.toString());
				} else if(enterpriseCrowdingConfigEntity) {
				  gsaGlobalParams.setEnterpriseCrowdingConfig(ch.toString());
				} else if(entityDefinitionEntity) {
				  gsaGlobalParams.setEntityDefinition(ch.toString());
				} else if(entityGrammarsDefinitionEntity) {
				  gsaGlobalParams.setEntityGrammarsDefinition(ch.toString());
				} else if(entityMaxWordsEntity) {
				  gsaGlobalParams.setEntityMaxWords(ch.toString());
				} else if(entityPunctuationFileEntity) {
				  gsaGlobalParams.setEntityPunctuationFile(ch.toString());
				} else if(entityPunctuationSpaceFileEntity) {
				  gsaGlobalParams.setEntityPunctuationSpaceFile(ch.toString());
				} else if(entityBlacklistEntity) {
				  gsaGlobalParams.setEntityBlacklist(ch.toString());
				} else if(escorerGaConfigEntity) {
				  gsaGlobalParams.setEscorerGaConfig(ch.toString());
				} else if(estimatesInSecureSearchesEntity) {
				  gsaGlobalParams.setEstimatesInSecureSearches(ch.toString());
				} else if(expertSearchConfigEntity) {
				  gsaGlobalParams.setExpertSearchConfig(ch.toString());
				} else if(externalSSHEntity) {
				  gsaGlobalParams.setExternalSSH(ch.toString());
				} else if(federationConfigEntity) {
				  gsaGlobalParams.setFederationConfig(ch.toString());
				} else if(federationEnabledEntity) {
				  gsaGlobalParams.setFederationEnabled(ch.toString());
				} else if(federationUIEnabledEntity) {
				  gsaGlobalParams.setFederationUIEnabled(ch.toString());
				} else if(feederConnectorManagerTrustedClientsEntity) {
				  gsaGlobalParams.setFeederConnectorManagerTrustedClients(ch.toString());
				} else if(feederTrustedClientsEntity) {
				  gsaGlobalParams.setFeederTrustedClients(ch.toString());
				} else if(footerEmailEntity) {
				  gsaGlobalParams.setFooterEmail(ch.toString());
				} else if(forceRecrawlUrlsEntity) {
				  gsaGlobalParams.setForceRecrawlUrls(ch.toString());
				} else if(frequentUrlsEntity) {
				  gsaGlobalParams.setFrequentUrls(ch.toString());
				} else if(goodUrlsEntity) {
				  gsaGlobalParams.setGoodUrls(ch.toString());
				} else if(googleAppsUnificationEnabledEntity) {
				  gsaGlobalParams.setGoogleAppsUnificationEnabled(ch.toString());
				} else if(gsaEntityIdEntity) {
				  gsaGlobalParams.setGsaEntityId(ch.toString());
				} else if(headerEmailEntity) {
				  gsaGlobalParams.setHeaderEmail(ch.toString());
				} else if(httpHeadersEntity) {
				  gsaGlobalParams.setHttpHeaders(ch.toString());
				} else if(ignoreAnchorsForSnippetsEntity) {
				  gsaGlobalParams.setIgnoreAnchorsForSnippets(ch.toString());
				} else if(indexServerDropDenyDecisionEntity) {
				  gsaGlobalParams.setIndexServerDropDenyDecision(ch.toString());
				} else if(infrequentUrlsEntity) {
				  gsaGlobalParams.setInfrequentUrls(ch.toString());
				} else if(kmStartEntity) {
				  gsaGlobalParams.setKmStart(ch.toString());
				} else if(ldapConfigEntity) {
				  gsaGlobalParams.setLdapConfig(ch.toString());
				} else if(ldapManagerGroupEntity) {
				  gsaGlobalParams.setLdapManagerGroup(ch.toString());
				} else if(ldapSuperUserGroupEntity) {
				  gsaGlobalParams.setLdapSuperUserGroup(ch.toString());
				} else if(multiBoxUIEnabledEntity) {
				  gsaGlobalParams.setMultiBoxUIEnabled(ch.toString());
				} else if(notificationEmailEntity) {
				  gsaGlobalParams.setNotificationEmail(ch.toString());
				} else if(onboardSecurityManagerEnabledEntity) {
				  gsaGlobalParams.setOnboardSecurityManagerEnabled(ch.toString());
				} else if(oneboxBackendConfigEntity) {
				  gsaGlobalParams.setOneboxBackendConfig(ch.toString());
				} else if(oneboxConfigEntity) {
				  gsaGlobalParams.setOneboxConfig(ch.toString());
				} else if(outgoingSenderEntity) {
				  gsaGlobalParams.setOutgoingSender(ch.toString());
				} else if(parametricConfigHasEntitiesEntity) {
				  gsaGlobalParams.setParametricConfigHasEntities(ch.toString());
				} else if(parametricSearchConfigEntity) {
				  gsaGlobalParams.setParametricSearchConfig(ch.toString());
				} else if(parametricSearchEnabledEntity) {
				  gsaGlobalParams.setParametricSearchEnabled(ch.toString());
				} else if(peopleSearchConfigEntity) {
				  gsaGlobalParams.setPeopleSearchConfig(ch.toString());
				} else if(peopleSearchMaxResultsEntity) {
				  gsaGlobalParams.setPeopleSearchMaxResults(ch.toString());
				} else if(perimeterSecurityEnabledEntity) {
				  gsaGlobalParams.setPerimeterSecurityEnabled(ch.toString());
				} else if(problemEmailEntity) {
				  gsaGlobalParams.setProblemEmail(ch.toString());
				} else if(proxyConfigEntity) {
				  gsaGlobalParams.setProxyConfig(ch.toString());
				} else if(queryExpStatusEntity) {
				  gsaGlobalParams.setQueryExpStatus(ch.toString());
				} else if(redirectHttpsEntity) {
				  gsaGlobalParams.setRedirectHttps(ch.toString());
				} else if(remoteCollectionsConfigEntity) {
				  gsaGlobalParams.setRemoteCollectionsConfig(ch.toString());
				} else if(remoteFrontendFilterEnabledEntity) {
				  gsaGlobalParams.setRemoteFrontendFilterEnabled(ch.toString());
				} else if(removeLegacyAuthNEntity) {
				  gsaGlobalParams.setRemoveLegacyAuthN(ch.toString());
				} else if(rewriteIndexHtmlEntity) {
				  gsaGlobalParams.setRewriteIndexHtml(ch.toString());
				} else if(rewritePositionTypeQueriesEntity) {
				  gsaGlobalParams.setRewritePositionTypeQueries(ch.toString());
				} else if(samlMetadataEntity) {
				  gsaGlobalParams.setSamlMetadata(ch.toString());
				} else if(scoringAdditionalPoliciesEntity) {
				  gsaGlobalParams.setScoringAdditionalPolicies(ch.toString());
				} else if(scoringAdjustEntity) {
				  gsaGlobalParams.setScoringAdjust(ch.toString());
				} else if(scoringConfigEntity) {
				  gsaGlobalParams.setScoringConfig(ch.toString());
				} else if(sessionIdleTimeEntity) {
				  gsaGlobalParams.setSessionIdleTime(ch.toString());
				} else if(smtpServerEntity) {
				  gsaGlobalParams.setSmtpServer(ch.toString());
				} else if(snippetLengthEntity) {
				  gsaGlobalParams.setSnippetLength(ch.toString());
				} else if(startUrlsEntity) {
				  gsaGlobalParams.setStartUrls(ch.toString());
				} else if(strictCookieComainEntity) {
				  gsaGlobalParams.setStrictCookieComain(ch.toString());
				} else if(strictPasswordEnforcementEntity) {
				  gsaGlobalParams.setStrictPasswordEnforcement(ch.toString());
				} else if(suggestBlacklistEntity) {
				  gsaGlobalParams.setSuggestBlacklist(ch.toString());
				} else if(suggestCollectionsEntity) {
				  gsaGlobalParams.setSuggestCollections(ch.toString());
				} else if(suggestKeywordsEntity) {
				  gsaGlobalParams.setSuggestKeywords(ch.toString());
				} else if(syslogServerEntity) {
				  gsaGlobalParams.setSyslogServer(ch.toString());
				} else if(totalRecallEntity) {
				  gsaGlobalParams.setTotalRecall(ch.toString());
				} else if(translationIntegrationEntity) {
				  gsaGlobalParams.setTranslationIntegration(ch.toString());
				} else if(trustConfigEntity) {
				  gsaGlobalParams.setTrustConfig(ch.toString());
				} else if(uarEnableAuthNEntity) {
				  gsaGlobalParams.setUarEnableAuthN(ch.toString());
				} else if(uniLoginCustomisationEntity) {
				  gsaGlobalParams.setUniLoginCustomisation(ch.toString());
				} else if(useDefaultBackOffEntity) {
				  gsaGlobalParams.setUseDefaultBackOff(ch.toString());
				} else if(userAccountsEntity) {
				  gsaGlobalParams.setUserAccounts(ch.toString());
				} else if(userAgentEntity) {
				  gsaGlobalParams.setUserAgent(ch.toString());
				} else if(wildcardCompleteIndexingEntity) {
				  gsaGlobalParams.setWildcardCompleteIndexing(ch.toString());
				} else if(wildcardsEnabledEntity) {
				  gsaGlobalParams.setWildcardsEnabled(ch.toString());
				}
			}
			
			@Override
			public void endElement(String uri, String localName, String qName) throws SAXException {
				//collections
		    if (qName.equalsIgnoreCase("collection") && gsaCollection != null) {
		    	gcList.add(gsaCollection);
			} else if (qName.equalsIgnoreCase("bad_urls")) { 
				badUrlEntity = false;
			} else if (qName.equalsIgnoreCase("good_urls")) { 
				goodUrlEntity = false;
			} else if (qName.equalsIgnoreCase("prerequisite_results")) { 
				preReqResultEntiy = false;
			} else if (qName.equalsIgnoreCase("testwords")) { 
				testWordsEntity = false;
			} else if (qName.equalsIgnoreCase("stylesheet")) {
				stylesheetEntity = true;					
			} else if (qName.equalsIgnoreCase("synonyms")) {
				synonymEntity = false;					
			}  else if (qName.equalsIgnoreCase("wildcard_wc_filter")) {
				wcFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("default_language")) {
				defaultLangEntity = false;					
			} else if (qName.equalsIgnoreCase("profile_sheet")) {
				profileSheetEntity = false;					
			} else if (qName.equalsIgnoreCase("profile_sheet.en")) {
				profileSheetEnEntity = false;					
			} else if (qName.equalsIgnoreCase("badurls_noreturn")) {
				badUrlsNoReturnEntity = false;					
			} else if (qName.equalsIgnoreCase("domain_filter")) {
				domainFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("filetype_filter")) {
				fileTypeFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("good_ips")) {
				goodIPEntity = false;					
			} else if (qName.equalsIgnoreCase("googlematch")) {
				googleMatchEntity = false;					
			} else if (qName.equalsIgnoreCase("lang_filter")) {
				langFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("metatag_filter")) {
				metatagFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("query_expansion_filter")) {
				queryExpansionFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("query_expansion_meta_filter")) {
				queryExpansionMetaFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("scoring_policy_filter")) {
				scoringPolicyFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("star_wildcard_default_filter")) {
				starWildCardDefaultFilterEntity = false;					
			} else if (qName.equalsIgnoreCase("_google_apps_domain")) {
				 googleAppsDomainEntity = false;
			} else if (qName.equalsIgnoreCase("acl_inheritance_ser_ascii")) {
				aclInheritanceEntity = false;
			} else if (qName.equalsIgnoreCase("active_language_bundle")) {
				activeLanguageBundleEntity = false;
			} else if (qName.equalsIgnoreCase("admin_console_auth_mode")) {
				adminConsoleAuthModeEntity = false;
			} else if (qName.equalsIgnoreCase("admin_http_enable")) {
			 adminHttpEnableEntity = false;
			} else if (qName.equalsIgnoreCase("alerts2")) {
			 alertsEntity = false;
			} else if (qName.equalsIgnoreCase("alerts_footer_email")) {
			 alertFooterEmailEntity = false;
			} else if (qName.equalsIgnoreCase("alerts_header_email")) {
			 alertHeaderEmailEntity = false;
			} else if (qName.equalsIgnoreCase("auth_domains")) {
			 authDomainsEntity = false;
			} else if (qName.equalsIgnoreCase("authenticate_client_cert")) {
			 authClientCertEntity = false;
			} else if (qName.equalsIgnoreCase("authenticate_onebox_server_cert")) {
			 authOneBoxCertEntity = false;
			} else if (qName.equalsIgnoreCase("authenticate_server_cert")) {
			 authServerCertEntity = false;
			} else if (qName.equalsIgnoreCase("authn_artifact_service_url")) {
			 authnArtifactServiceUrlEntity = false;
			} else if (qName.equalsIgnoreCase("authn_login_Url")) {
			 authnLoginUrlEntity = false;
			} else if (qName.equalsIgnoreCase("authz_service_url")) {
			 authzServiceUrlEntity = false;
			} else if (qName.equalsIgnoreCase("autocomplete_off")) {
			 autoCompleteEntity = false;
			} else if (qName.equalsIgnoreCase("backoff_remove_index_info")) {
			 backoffRemoveIndexEntity = false;
			} else if (qName.equalsIgnoreCase("bad_urls")) {
			 badUrlsEntity = false;
			} else if (qName.equalsIgnoreCase("basic_auth_challenge_tpye")) {
			 basicAuthChallengeTypeEntity = false;
			} else if (qName.equalsIgnoreCase("batch_crawl_mode")) {
			 batchCrawlModeEntity = false;
			} else if (qName.equalsIgnoreCase("clickboost")) {
			 clickBoostEntity = false;
			} else if (qName.equalsIgnoreCase("clickboost_data")) {
			 clickBoostDataEntity = false;
			} else if (qName.equalsIgnoreCase("clickboost_summary_data")) {
			 clickBoostSummaryDataEntity = false;
			} else if (qName.equalsIgnoreCase("clickjacking_defense")) {
			 clickJackingDefenseEntity = false;
			} else if (qName.equalsIgnoreCase("clicklogging")) {
			 clickLoggingEntity = false;
			} else if (qName.equalsIgnoreCase("convert_to_lowercase_urls")) {
			 lowercaseUrlsEntity = false;
			} else if (qName.equalsIgnoreCase("cookie_domain")) {
			 cookieDomainEntity = false;
			} else if (qName.equalsIgnoreCase("coverage_config")) {
			 coverageConfigEntity = false;
			} else if (qName.equalsIgnoreCase("default_search_url")) {
			 defaultSearchUrlEntity = false;
			} else if (qName.equalsIgnoreCase("delegated_authz_enabled")) {
			 delegatedAuthZEntity = false;
			} else if (qName.equalsIgnoreCase("deny_rules_config")) {
			 denyRulesConfigEntity = false;
			} else if (qName.equalsIgnoreCase("disable_infinitespace_check")) {
			 disableInfiniteSpaceEntity = false;
			} else if (qName.equalsIgnoreCase("disable_legacy_authn")) {
			 disableLegacyAuthNEntity = false;
			} else if (qName.equalsIgnoreCase("dns_override")) {
			 dnsOverrideEntity = false;
			} else if (qName.equalsIgnoreCase("do_entity_extraction")) {
			 doEntityExtractionEntity = false;
			} else if (qName.equalsIgnoreCase("documill_disk_size_buffer_percentage")) {
			 docuMillDiskSizeBufferEntity = false;
			} else if (qName.equalsIgnoreCase("documill_disk_size_limit")) {
			 docuMillDiskSizeLimitEntity = false;
			} else if (qName.equalsIgnoreCase("documill_max_pages")) {
			 docuMillMaxPagesEntity = false;
			} else if (qName.equalsIgnoreCase("documill_num_threads")) {
			 docuMillNumThreadsEntity = false;
			} else if (qName.equalsIgnoreCase("documill_resolution")) {
			 docuMillResolutionEntity = false;
			} else if (qName.equalsIgnoreCase("dup_hosts")) {
			 dupHostsEntity = false;
			} else if (qName.equalsIgnoreCase("enable_check_suggests_exist_in_index")) {
			 enableCheckSuggestsExistInIndexEntity = false;
			} else if (qName.equalsIgnoreCase("enable_context_syns_for_one_word_queries")) {
			 enableContextSynsOneWordQueriesEntity = false;
			} else if (qName.equalsIgnoreCase("enable_default_truststore")) {
			 enableTrustStoreEntity = false;
			} else if (qName.equalsIgnoreCase("enable_diacritical_eq")) {
			 enableDiacriticalEqEntity = false;
			} else if (qName.equalsIgnoreCase("enable_diacrititcs_expansion_in_meta_tag_values")) {
			 enableDiacrititcsExpansionEntity = false;
			} else if (qName.equalsIgnoreCase("enable_dirty_words")) {
			 enableDirtyWordsEntity = false;
			} else if (qName.equalsIgnoreCase("enable_documill")) {
			 enableDocuMillEntity = false;
			} else if (qName.equalsIgnoreCase("enable_infinite_space_detection")) {
			 enableInfiniteSpaceDetectionEntity = false;
			} else if (qName.equalsIgnoreCase("enable_kerberos_crawling")) {
			 enableKerberosCrawlingEntity = false;
			} else if (qName.equalsIgnoreCase("enable_late_binding_acl")) {
			 enableLateBindingACLEntity = false;
			} else if (qName.equalsIgnoreCase("enable_log_manager")) {
			 enableLogManagerEntity = false;
			} else if (qName.equalsIgnoreCase("enable_partialfields_expansion")) {
			 enablePartialFieldsExpansionEntity = false;
			} else if (qName.equalsIgnoreCase("enable_phrase_suggest")) {
			 enablePhraseSuggestEntity = false;
			} else if (qName.equalsIgnoreCase("enable_query_log_suggest")) {
			 enableQueryLogSuggestEntity = false;
			} else if (qName.equalsIgnoreCase("enable_secure_search_api")) {
			 enableSecureSearchEntity = false;
			} else if (qName.equalsIgnoreCase("enable_snmp")) {
			 enableSNMPEntity = false;
			} else if (qName.equalsIgnoreCase("enable_uar_suggest")) {
			 enableUARSuggestEntity = false;
			} else if (qName.equalsIgnoreCase("ent_enable_feedergate_client_certs")) {
			 enableFeedergateClientCertsEntity = false;
			} else if (qName.equalsIgnoreCase("ent_enable_feedergate_http")) {
			 enableFeedergateHttpEntity = false;
			} else if (qName.equalsIgnoreCase("enterprise_crowding_config_file")) {
			 enterpriseCrowdingConfigEntity = false;
			} else if (qName.equalsIgnoreCase("entity_definition")) {
			 entityDefinitionEntity = false;
			} else if (qName.equalsIgnoreCase("entity_grammars_definition")) {
			 entityGrammarsDefinitionEntity = false;
			} else if (qName.equalsIgnoreCase("entity_max_words_window")) {
			 entityMaxWordsEntity = false;
			} else if (qName.equalsIgnoreCase("entity_punctuation_marks_file")) {
			 entityPunctuationFileEntity = false;
			} else if (qName.equalsIgnoreCase("entity_punctuation_marks_if_next_to_space_file")) {
			 entityPunctuationSpaceFileEntity = false;
			} else if (qName.equalsIgnoreCase("entity_terms_blacklist")) {
			 entityBlacklistEntity = false;
			} else if (qName.equalsIgnoreCase("escorer_training_ga_config_file")) {
			 escorerGaConfigEntity = false;
			} else if (qName.equalsIgnoreCase("estimates_in_secure_searches")) {
			 estimatesInSecureSearchesEntity = false;
			} else if (qName.equalsIgnoreCase("expert_search_config")) {
			 expertSearchConfigEntity = false;
			} else if (qName.equalsIgnoreCase("external_ssh")) {
			 externalSSHEntity = false;
			} else if (qName.equalsIgnoreCase("federation_config")) {
			 federationConfigEntity = false;
			} else if (qName.equalsIgnoreCase("federation_enabled")) {
			 federationEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("federation_ui_enabled")) {
			 federationUIEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("feeder_connector_manager_trusted_clients")) {
			 feederConnectorManagerTrustedClientsEntity = false;
			} else if (qName.equalsIgnoreCase("feeder_trusted_clients")) {
			 feederTrustedClientsEntity = false;
			} else if (qName.equalsIgnoreCase("footer_email")) {
			 footerEmailEntity = false;
			} else if (qName.equalsIgnoreCase("force_recrawl_urls")) {
			 forceRecrawlUrlsEntity = false;
			} else if (qName.equalsIgnoreCase("frequent_urls")) {
			 frequentUrlsEntity = false;
			} else if (qName.equalsIgnoreCase("good_urls")) {
			 goodUrlsEntity = false;
			} else if (qName.equalsIgnoreCase("google_apps_unification_enabled")) {
			 googleAppsUnificationEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("gsa_entity_id")) {
			 gsaEntityIdEntity = false;
			} else if (qName.equalsIgnoreCase("header_email")) {
			 headerEmailEntity = false;
			} else if (qName.equalsIgnoreCase("http_headers")) {
			 httpHeadersEntity = false;
			} else if (qName.equalsIgnoreCase("ignore_anchors_for_snippets")) {
			 ignoreAnchorsForSnippetsEntity = false;
			} else if (qName.equalsIgnoreCase("indexserver_drop_deny_decisions")) {
			 indexServerDropDenyDecisionEntity = false;
			} else if (qName.equalsIgnoreCase("infrequent_urls")) {
			 infrequentUrlsEntity = false;
			} else if (qName.equalsIgnoreCase("km_start")) {
			 kmStartEntity = false;
			} else if (qName.equalsIgnoreCase("ldap_config")) {
			 ldapConfigEntity = false;
			} else if (qName.equalsIgnoreCase("ldap_manager_group")) {
			 ldapManagerGroupEntity = false;
			} else if (qName.equalsIgnoreCase("ldap_superuser_group")) {
			 ldapSuperUserGroupEntity = false;
			} else if (qName.equalsIgnoreCase("multibox_ui_enabled")) {
			 multiBoxUIEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("notification_email")) {
			 notificationEmailEntity = false;
			} else if (qName.equalsIgnoreCase("onboard_security_manager_enabled")) {
			 onboardSecurityManagerEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("onebox_backend_config")) {
			 oneboxBackendConfigEntity = false;
			} else if (qName.equalsIgnoreCase("onebox_config")) {
			 oneboxConfigEntity = false;
			} else if (qName.equalsIgnoreCase("outgoing_sender")) {
			 outgoingSenderEntity = false;
			} else if (qName.equalsIgnoreCase("parametric_config_has_entities")) {
			 parametricConfigHasEntitiesEntity = false;
			} else if (qName.equalsIgnoreCase("parametric_search_config")) {
			 parametricSearchConfigEntity = false;
			} else if (qName.equalsIgnoreCase("parametric_search_enabled")) {
			 parametricSearchEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("people_search_config")) {
			 peopleSearchConfigEntity = false;
			} else if (qName.equalsIgnoreCase("people_search_maximum_search_results")) {
			 peopleSearchMaxResultsEntity = false;
			} else if (qName.equalsIgnoreCase("perimeter_security_enabled")) {
			 perimeterSecurityEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("problem_email")) {
			 problemEmailEntity = false;
			} else if (qName.equalsIgnoreCase("proxy_config")) {
			 proxyConfigEntity = false;
			} else if (qName.equalsIgnoreCase("query_exp_status")) {
			 queryExpStatusEntity = false;
			} else if (qName.equalsIgnoreCase("redirect_https")) {
			 redirectHttpsEntity = false;
			} else if (qName.equalsIgnoreCase("remote_collections_cfg")) {
			 remoteCollectionsConfigEntity = false;
			} else if (qName.equalsIgnoreCase("remote_frontend_filter_enabled")) {
			 remoteFrontendFilterEnabledEntity = false;
			} else if (qName.equalsIgnoreCase("remove_legacy_authn")) {
			 removeLegacyAuthNEntity = false;
			} else if (qName.equalsIgnoreCase("rewrite_index_html")) {
			 rewriteIndexHtmlEntity = false;
			} else if (qName.equalsIgnoreCase("rewrite_position_type_queries")) {
			 rewritePositionTypeQueriesEntity = false;
			} else if (qName.equalsIgnoreCase("saml_metadata")) {
			 samlMetadataEntity = false;
			} else if (qName.equalsIgnoreCase("scoring_additional_policies")) {
			 scoringAdditionalPoliciesEntity = false;
			} else if (qName.equalsIgnoreCase("scoring_adjust")) {
			 scoringAdjustEntity = false;
			} else if (qName.equalsIgnoreCase("scoring_config")) {
			 scoringConfigEntity = false;
			} else if (qName.equalsIgnoreCase("session_idle_time")) {
			 sessionIdleTimeEntity = false;
			} else if (qName.equalsIgnoreCase("smtp_server")) {
			 smtpServerEntity = false;
			} else if (qName.equalsIgnoreCase("snippet_length")) {
			 snippetLengthEntity = false;
			} else if (qName.equalsIgnoreCase("start_urls")) {
			 startUrlsEntity = false;
			} else if (qName.equalsIgnoreCase("strict_cookie_domain_check")) {
			 strictCookieComainEntity = false;
			} else if (qName.equalsIgnoreCase("strict_password_enforcement")) {
			 strictPasswordEnforcementEntity = false;
			} else if (qName.equalsIgnoreCase("suggest_blacklist")) {
			 suggestBlacklistEntity = false;
			} else if (qName.equalsIgnoreCase("suggest_collections")) {
			 suggestCollectionsEntity = false;
			} else if (qName.equalsIgnoreCase("suggest_keywords")) {
			 suggestKeywordsEntity = false;
			} else if (qName.equalsIgnoreCase("syslog_server")) {
			 syslogServerEntity = false;
			} else if (qName.equalsIgnoreCase("total_recall")) {
			 totalRecallEntity = false;
			} else if (qName.equalsIgnoreCase("translation_integration")) {
			 translationIntegrationEntity = false;
			} else if (qName.equalsIgnoreCase("trust_config")) {
			 trustConfigEntity = false;
			} else if (qName.equalsIgnoreCase("uar_enable_authn")) {
			 uarEnableAuthNEntity = false;
			} else if (qName.equalsIgnoreCase("uni_login_customization")) {
			 uniLoginCustomisationEntity = false;
			} else if (qName.equalsIgnoreCase("use_default_backoffs_removals")) {
			 useDefaultBackOffEntity = false;
			} else if (qName.equalsIgnoreCase("user_accounts")) {
			 userAccountsEntity = false;
			} else if (qName.equalsIgnoreCase("user_agent")) {
			 userAgentEntity = false;
			} else if (qName.equalsIgnoreCase("wildcards_complete_indexing")) {
			 wildcardCompleteIndexingEntity = false;
			} else if (qName.equalsIgnoreCase("wildcards_enable")) {
			 wildcardsEnabledEntity = false;
			}
			
		}

		}
}
