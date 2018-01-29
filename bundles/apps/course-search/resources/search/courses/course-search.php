<?php
/**
 * @author Steve Webb / Scott Speers
 * @version 2.4
 * 
 * latest feature: added support for using XML Restful services to deliver filter options
 * 
 */

// DEFAULT is only supported for radio filter options (this is due to bbq.js as well)

require_once('/var/www/search/dmsbt/dmsbt_search_unencoded.php');

class scu_search extends dmsbt_search
{
    
    //these are default opts settings for web service requests
    private 
        $opts = array('http'=>array('method'=>"GET",
                                    //'header'=>"Cache-Control: no-cache",
                                    'timeout'=> 15));       
    private
        $ajaxRequest = false;
    private
        $intDomSelection = 'INT-ON';
    private 
        $studPrdDesc = 'Study Period';
    private
        $sessDesc    = 'Session';
    private
        $resSemDesc  = 'Research Semester';
    private 
        $sessionAvailCodes = array('11','12','13');
    private 
        $resSemAvailCodes = array('R1','R3');
    private
        $otherAvailCodes = array('YL');
    private
        $studyPeriodAvailCodes = array('21', '22', '23', '24', '25', '26');

    private
        $searchType = 'courses';
    
    //filter groups are used to map squiz metadata tag fields to groupings - these are ran over the filter options prior to a search
    
    private
        $filterGroups = array('courses%2Eavail-combo'     => array('fields' => array('offshore-location', 'location', 'session'), 'tabs' => array('DOM'), 'spks' => array('course', 'unit')),
                              'courses%2Eint-avail-combo' => array('fields' => array('offshore-location', 'location', 'session'), 'tabs' => array('INT-ON', 'OFFSHORE'), 'spks' => array('course', 'unit'))
        );
    //filter constraints used to constrain fuzzy OR groupings to a subset of required fields 
    private
        $complexFilters = array('OFFSHORE' => array('type' => 'partial', 'val' => '(courses%2Edom-int-intakes:INT-OFF|(courses%2Edom-int-intakes:DOM.courses%2Eavail-combo:NZ))', 'filterKey' => 'courses%2Edom-int-intakes')
        );
        
    private 
        $filterRemaps = array('values' => array('NZ' => 'courses%2Eavail-combo'));
    private 
        $filterOptions = array('courses%2Edom-int-intakes'  => array('type'  => 'check', 'title' => 'Available to', 'customClass' => 'dom-int-options',
                                                                    'tabs'   => array('OFFSHORE', 'INT-ON', 'DOM'),
                                                                    'spks'   => array('course', 'unit'),
                                                                    'collapsible' => FALSE,
                                                                    'values' => array('DOM'      => array('printName' => 'Domestic students', 'val' => 0, 'default' => 1), 
                                                                                    'INT-ON'       => array('printName' => 'International onshore students', 'val' => 0),
                                                                                    'OFFSHORE'      => array('printName' => 'International offshore students', 'val' => 0))),
                                
                                //'int-link'                  => array('type'  => 'text', 'title' => '<a href="http://www.scu.edu.au/international">International offshore students</a>', 
                                //                                    'tabs'   => array('INT'),
                                //                                    'spks'   => array('courses', 'units'),
                                //                                    'values' =>  array()),
                                                                              
                                //'courses%2Eyear'             => array('type'  => 'select', 'title' => 'Years <span id="prev-yr-link"><a href="">view previous years</a></span>', 
                                'courses%2Eyear'             => array('type'  => 'select', 'title' => 'Years', 
                                                                    'tabs'   => array('OFFSHORE', 'INT-ON', 'DOM'),
                                                                    'spks'   => array('course', 'unit'),
                                                                    'collapsible' => FALSE,
                                                                    'values' => array(''        => array('printName' => 'All', 'val' => 0),
                                                                                    '2014'      => array('printName' => '2014', 'val' => 0), 
                                                                                    '2015'      => array('printName' => '2015', 'val' => 0),
                                                                                    '2016'      => array('printName' => '2016', 'val' => 0),
                                                                                    '2017'      => array('printName' => '2017', 'val' => 0),
                                                                                    '2018'      => array('printName' => '2018', 'val' => 0),
                                                                                    'NOTE'      => array('printName' => '<span id="prev-yr-link"><a href="http://scu.edu.au/docs/handbook/index.php/dds" onclick="_gaq.push([\'_trackEvent\', \'CourseSearch\', \'SearchOptions\', \'ViewPreviousYears\', 0, true]);">view previous years</a></span>', 'val' => 0))),
                                                                                 
                                'courses%2Eaward-level-type'     => array('type'  => 'check', 'title' => 'Course level', 
                                                                    'tabs'   => array('OFFSHORE', 'INT-ON', 'DOM'),
                                                                    'spks'   => array('course'),
                                                                    'collapsible' => TRUE,
                                                                    'values' => array('N'    => array('printName' => 'Preparation', 'val' => 0), 
                                                                                    'UG'        => array('printName' => 'Undergraduate', 'val' => 0), 
                                                                                    'HON'   => array('printName' => 'Honours', 'val' => 0),
                                                                                    'PG'       => array('printName' => 'Postgraduate coursework', 'val' => 0),
                                                                                    'NOTE'      => array('printName' => '<a href="http://scu.edu.au/graduateschool/index.php/12">Higher degrees by research</a>', 'val' => 0))),
                                
                                'courses%2Eaward-level-type2'     => array('type'  => 'check', 'title' => 'Unit level', 
                                                                    'tabs'   => array('OFFSHORE', 'INT-ON', 'DOM'),
                                                                    'spks'   => array('unit'),
                                                                    'collapsible' => TRUE,
                                                                    'values' => array('N'    => array('printName' => 'Preparation', 'val' => 0), 
                                                                                    'UG'        => array('printName' => 'Undergraduate', 'val' => 0), 
                                                                                    'PG'       => array('printName' => 'Postgraduate', 'val' => 0))),
                                         
                                'session'                   => array('type'  => 'check', 'title' => 'Session', 
                                                                    'tabs'   => array('OFFSHORE', 'INT-ON', 'DOM'),
                                                                    'spks'   => array('course', 'unit'),
                                                                    'collapsible' => TRUE,
                                                                    'values' => array('NOTE'      => array('printName' => 'See the <a href="http://www.scu.edu.au/futurestudents/index.php/7">teaching calendar</a> for information about intakes', 'val' => 0))),
                                                                                    
                                //'intake-note'               => array('type'  => 'text', 'title' => 'See the <a href="http://www.scu.edu.au/teachingcalendar">teaching calendar</a> for information about intakes', 
                                //                                    'tabs'   => array('INT', 'DOM'),
                                //                                    'spks'   => array('courses', 'units'),
                                //                                    'values' => array()),
                                                                                    
                                'location'                  => array('type'  => 'check', 'title' => 'Location', 
                                                                    'tabs'   => array('INT-ON', 'DOM'),
                                                                    'spks'   => array('course', 'unit'),
                                                                    'customClass' => 'onshore',
                                                                    'collapsible' => TRUE,
                                                                    'values' => array('GCB'        => array('printName' => 'Gold Coast', 'val' => 0),
                                                                                    'L'         => array('printName' => 'Lismore', 'val' => 0),
                                                                                    'CH'      => array('printName' => 'Coffs Harbour', 'val' => 0),
                                                                                    'U|OL'         => array('printName' => 'Online', 'val' => 0),
                                                                                    'MSC'         => array('printName' => 'National Marine Science Centre', 'val' => 0),
                                                                                    'PER' => array('printName' => 'Perth', 'val' => 0),
                                                                                    'SYD'         => array('printName' => 'Sydney', 'val' => 0),
                                                                                    'S'         => array('printName' => 'The Hotel School Sydney', 'val' => 0),
                                                                                    'MLB'         => array('printName' => 'Melbourne', 'val' => 0),
                                                                                    'MEL'         => array('printName' => 'The Hotel School Melbourne', 'val' => 0) // MEL not needed until Melbourne Hotel School courses are available - as per Myeka Page
                                                                    )),
                                
                                'courses%2Eprimary-owner'      => array('type'  => 'check', 'title' => 'School', 
                                                                    'tabs'   => array('OFFSHORE', 'INT-ON', 'DOM'),
                                                                    'spks'   => array('unit'),
                                                                    'collapsible' => TRUE,
                                                                    'values' => array(/*''        => array('printName' => 'All', 'val' => 0),*/
                                                                                    '92'  => array('printName' => 'College of Indigenous Australian Peoples', 'val' => 0), 
                                                                                    '99'  => array('printName' => 'SCU College', 'val' => 0),
                                                                                    '88' => array('printName' => 'School of Arts &amp; Social Sciences', 'val' => 0), 
                                                                                    '10'  => array('printName' => 'School of Education', 'val' => 0), 
                                                                                    '50'    => array('printName' => 'School of Environment, Science &amp; Engineering', 'val' => 0), 
                                                                                    '54'        => array('printName' => 'School of Health &amp; Human Sciences', 'val' => 0), 
                                                                                    '14'  => array('printName' => 'School of Law &amp; Justice', 'val' => 0),
                                                                                    '47'        => array('printName' => 'School of Business &amp; Tourism', 'val' => 0) )),
                                
                                'courses%2Esecondary-discipline'      => array('type'  => 'check', 'title' => 'Study area', 
                                                                    'tabs'   => array('OFFSHORE', 'INT-ON', 'DOM'),
                                                                    'spks'   => array('course'),
                                                                    'collapsible' => TRUE,
                                                                    'values' => array(/*''        => array('printName' => 'All', 'val' => 0),*/
                                                                                    'business'  => array('printName' => 'Business', 'val' => 0), 
                                                                                    'education' => array('printName' => 'Education', 'val' => 0), 
                                                                                    'environment'  => array('printName' => 'Environment, Science and Engineering', 'val' => 0), 
                                                                                    'health'    => array('printName' => 'Health and Human Sciences', 'val' => 0), 
                                                                                    'arts' => array('printName' => 'Humanities and Social Sciences', 'val' => 0), 
                                                                                    'indigenous'  => array('printName' => 'Indigenous Studies', 'val' => 0), 
                                                                                    'information'  => array('printName' => 'Information Technology', 'val' => 0), 
                                                                                    'law'       => array('printName' => 'Law and Justice', 'val' => 0),
                                                                                    'creative'  => array('printName' => 'Creative Arts', 'val' => 0),
                                                                                    'tourism'   => array('printName' => 'Tourism and Hospitality', 'val' => 0) )),
                                                                                    
                                //'offshore-study'               => array('type'  => 'text', 'title' => '<h3>Study outside of Australia</h3><p>Some Southern Cross University courses are taught through education collaborations at locations outside of Australia. For information about units or courses taught offshore, contact the relevant education collaboration.</p>', 
                                //                                    'tabs'   => array('INT', 'DOM'),
                                //                                    'spks'   => array('courses', 'units'),
                                //                                    'values' => array())
                                                                    /*,
                                                                    
                                'courses%2EATAR-range'      => array('type'  => 'check', 'title' => 'ATAR', 
                                                                    'tabs'   => array(''),
                                                                    'spks'   => array(''),
                                                                    'values' => array('60-69'   => array('printName' => '60-69', 'val' => 0),
                                                                                    '70-74'     => array('printName' => '70-74', 'val' => 0),
                                                                                    '75-79'     => array('printName' => '75-79', 'val' => 0),
                                                                                    '80-84'     => array('printName' => '80-84', 'val' => 0),
                                                                                    '85-89'     => array('printName' => '85-89', 'val' => 0),
                                                                                    '90-94'     => array('printName' => '90-94', 'val' => 0),
                                                                                    '95-100'    => array('printName' => '95-100', 'val' => 0))),
                                
                                'courses%2EOP-range'        => array('type'  => 'check', 'title' => 'OP', 
                                                                    'tabs'   => array(''),
                                                                    'spks'   => array(''),
                                                                    'values' => array('20-16'   => array('printName' => '20-16', 'val' => 0),
                                                                                    '15-11'     => array('printName' => '15-11', 'val' => 0),
                                                                                    '10-6'      => array('printName' => '10-6', 'val' => 0),
                                                                                    '1-5'       => array('printName' => '1-5', 'val' => 0)))*/);
    
    
    public function __construct()
    {
        //set the header as UTF-8 to support ajax and postback requests
        header('Content-Type: text/html; charset=utf-8');
        if (!defined('_'))define('_',DIRECTORY_SEPARATOR);
        self::populateDynamicFilterOptions();
        self::setDefaultYear();
        //sort location alpha
        uasort ($this->filterOptions['location']['values'], array('scu_search','subAlphaPrintSort'));
        //gsa.scu.edu.au
        $this->setProtocol('https');
        $ini = parse_ini_file("gsa.ini");
        $vip = (string) (isset($ini['vip'])) ? $ini['vip'] : ENV_GSA_VIP;
        $this->setServer($vip);
        $this->setClient('course_search');
        $this->site = 'squiz-courses';
        
        $this->output           =(isset($_GET['output']))           ?$_GET['output']            :'xml_no_dtd';
        $this->proxystylesheet  =(isset($_GET['proxystylesheet']))  ?$_GET['proxystylesheet']   :'course_search';
        $this->proxycustom      =(isset($_GET['proxycustom']))      ?$_GET['proxycustom']       :'<HOME>';
        $this->ajaxRequest      =(isset($_GET['ajax']) && $_GET['ajax'] == 1);
        $this->proxyreload      =1;
        $this->sort             ='date:D:L:d1';
        $this->entqr            =3;
        $this->oe               ='UTF-8';
        $this->ie               ='UTF-8';
        $this->ud               =1;
        $this->getfields        ='*';
        $this->filter           =0;
        
        
        //make an api call to squiz to get offshore locations that have availabilities in json format
        //note this is in the squiz config global metadata which biztalk updates from UCMS
        $this->propagateWebGlobalsFromWS('web-global-xml', 'xml');
        $this->addFilterFromGlobals('offshoreLocations');        
        
        parent::__construct();
    }
    
        private function setDefaultYear() {
            $year = (strpos($_SERVER['REQUEST_URI'], 'unit') > 0) ? 2017 : 2018;
            $this->filterOptions['courses%2Eyear']['values'][$year]['default'] = '1';
            
        }

        private function populateDynamicFilterOptions() {
        $sessAvailArr = self::renderAvailArray($this->sessionAvailCodes, $this->sessDesc);
        $resSemAvailArr = self::renderAvailArray($this->resSemAvailCodes, $this->resSemDesc);
        $studyPdAvailArr = self::renderAvailArray($this->studyPeriodAvailCodes, $this->studPrdDesc);
        $otherAvailArr = self::renderAvailArray($this->otherAvailCodes);
        $sessFilterOptionTemplate = $this->filterOptions['session']['values'];

        //is it the courses script?
        if (strpos($_SERVER['SCRIPT_FILENAME'], 'courses') && !($_REQUEST['search-type'] === 'unit')) {
            $this->filterOptions['session']['values'] = $sessAvailArr + $studyPdAvailArr;
        } else {
            $this->filterOptions['session']['values'] = $resSemAvailArr + $sessAvailArr + $studyPdAvailArr + $otherAvailArr;
        }
        
        $this->filterOptions['session']['values'] = $this->filterOptions['session']['values'] + $sessFilterOptionTemplate;
        
        $type = (strpos($_SERVER['REQUEST_URI'], 'unit') > 0) ? 'check' : 'radio';
        $this->filterOptions['courses%2Edom-int-intakes']['type'] = $type;
        
    }

    private function renderAvailArray($codes, $desc = '') {
        $arr = array();
        foreach ($codes as $i => $code) {
            $displayName = ($code == 'YL') ? 'Year Long' : $desc .' ' . ($i + 1);
            $arr[$code] = array('printName' => $displayName, 'val' => 0);
        }
        return $arr;
    }

    private static function subAlphaPrintSort($a, $b) {
        return strcmp($a['printName'], $b['printName']);
    }
    
    
    private function searchForm($search_type = 'course', $extra_bits = '') {
        
        $other_search_url = ($search_type == 'course') ? 'http://search.'.ENV_DOMAIN.'/'.UNIT_DIR : 'http://search.'.ENV_DOMAIN.'/'.COURSE_DIR;
        $other_search_type = ($search_type == 'course') ? 'unit' : 'course';
                
        if (!isset($_GET['proxycustom']) || @$_GET['proxycustom']!='<ADVANCED/>') {
            
            $q='';
            if (!empty($_GET['q']))
            {
                $q=$_GET['q'];
            }
            elseif (!empty($_GET['as_q']))
            {
                $q=$_GET['as_q'];
            } else {
                $aq = ' ';
            }
            
            $crsSel = $unitSel = '';
            if ((isset($_GET['site']) && $_GET['site'] == 'squiz-units') || (isset($_GET['search-type']) && $_GET['search-type'] == 'unit')) {
                $unitSel = ' selected';
            } else {
                $crsSel = ' selected';
            }
            
            $q=str_replace(array("'", '"'), array('&apos;', '&quot;'), $q);

            $onclickAtt = ' onclick="_gaq.push([\'_trackEvent\', \''.ucwords($search_type).'Search\', \'Click\', \'SearchOptions-Search'.ucwords($other_search_type).'\', 0, true]);"';
            
            $searchInputAttr = (strpos($_SERVER['REQUEST_URI'], 'courses')) ? 'courses' : 'units';
            
            $html = '
        <input type="text" name="q" value="'.$q.'" id="GSA-search-input" maxlength="256" alt="Search Query" title="Enter search query" />
        <input type="submit" value="Search ' . $searchInputAttr . '" id="GSA-search-submit" />
        <span class="other-search"> or <a href="'.$other_search_url.'"'.$onclickAtt.'>search '.$other_search_type.'s</a>.</span>
        <!--<select id="search-type" name="search-type">
            <option value="course"'.$crsSel.'>Courses</option>
            <option value="unit"'.$unitSel.'>Units</option>
        </select>-->
        '.$extra_bits.'
        <script type="text/javascript">document.getElementById(\'GSA-search-input\').focus();</script>';
            
            return $html;
            
        } else {
            return '';
        }
    }
    /** Get and Set functions for setting new web service resource paths
     * @param string $path
     */
    
    private function setWSPath($path) {
        $this->webservice_path = $path;
    }
    
    private function getWSPath() {
        return rawurldecode($this->webservice_path);
    }
    
    private function propagateWebGlobalsFromWS($api, $format) {
        if (!isset($this->webservice_path)) {
            //default to Squiz search pages
            $this->setWSPath('http://' . ENV_SQUIZ_DOMAIN . '/feeds');
        }
        switch($format) {
            case 'xml':
                    $context = stream_context_create($this->opts);
                    $rawXML = file_get_contents($this->getWSPath() . '/' . $api , false, $context);
                    $feedXML = new SimpleXMLElement($rawXML);
                    $this->webglobals = $feedXML;
                break;
        }
    }
    
    /**
     * Used to get filter options from a third party web service
     * this was implemented to fulfil a requirement to get up to date availability location codes
     * from S1 via Squiz (instead of a db conn)
     * currently it is only set to consume json responses
     * 
     * @dependencies /var/www/php/classes/jsonHander.php class for decoding json
     * 
     * @param string $apis
     * @param string $format
     */
    private function addFilterFromGlobals($type) {
        //api is the restful state name
        switch($type) {
            case 'offshoreLocations':
                $offshoreLocations = array();
                $offshoreCds = array();
                
                foreach ($this->webglobals->{'offshore-locations'}->location_cd as $location_cd) {
                    $cd = (string) $location_cd;
                    $desc = (string) $location_cd['description'];
                    $offshoreCds[$cd] = array('printName' => $desc, 'val' => 0);
                }
                                
                if (!empty($offshoreCds)) {
                    $offshoreLocations = array( 'type' => 'check', 'title' => 'Location (Offshore)',
                            //the context of this filter is international offshore
                            'tabs' => array('INT-OFF', 'COMPLEX-OFFSH'),
                            //the spk types are courses only
                            'spks' => array('course', 'unit'),
                            //add an offshore custom class which is utilised in course-search.js
                            'customClass' => 'offshore',
                            'collapsible' => TRUE,
                            //put nested location code into values
                            'values' => $offshoreCds);
                }
                                
                if (!empty($offshoreLocations)) {
                    //construct temporary array holding the deliverables
                    $newArray = array('offshore-location' => $offshoreLocations);
                    //slice the filter options to position the offshore locations after the onshore locations
                    $this->filterOptions = array_slice($this->filterOptions, 0, 6, true) + 
                                           $newArray +
                                           //add the remaining keys after the 6th position index to the tail of the new filter options
                                           array_slice($this->filterOptions, 6, count($this->filterOptions) -1, true);
                }
                uasort ($this->filterOptions['offshore-location']['values'], array('scu_search','subAlphaPrintSort'));
                break;
        }
    }
    
    private function hasComplexGetPartial($fields) {
        $response = array();
        foreach($this->complexFilters as $key => $details) {
            if (preg_match('!' . $details['val'] . '!', $fields)) {
                $response[$key] = true;
            } else {
                continue;
            }
        }
        return $response;
    }
    
    private function convertComplexGetParams($complexKeys, $fields) {
        //remove the complex partial from field so that it can be processed by convertGetParams
        //later to be returned
        foreach($complexKeys as $key => $bool) {
            $fields = str_replace($this->complexFilters[$key]['val'], '', $fields);
            $pattern = '[\.|\|]';
            $fields = preg_replace('!^' . $pattern . '|' . $pattern . '$!', '', $fields);
            $filterKey = $this->complexFilters[$key]['filterKey'];
//          var_dump($this->filterOptions[$filterKey]);
            $this->filterOptions[$filterKey]['values'][$key]['val'] = 1;
        }
        return $fields;
    }
    
    // partialfields=(courses%252Ediscipline:business).(courses%252Eaward-level:prep%7Ccourses%252Eaward-level:ug)
    private function convertGetParams() {
                                
        $fields = array();
        $fieldVals = array();
        $key = $value = '';
        
        // Values may be in the GET string (user clicks on GSA generated link, e.g. Repeat search with omitted results)
        if (!empty($_GET['partialfields'])) {
            $fields = htmLawed($_GET['partialfields'], array('safe'=>1));
            
            $complexKeys = self::hasComplexGetPartial($fields); 
            if (!empty($complexKeys)) {
                $fields = self::convertComplexGetParams($complexKeys, $fields);
            }
//             var_dump($this->complexFilters);
            // Split the different fields we are searching over
            $fields = explode('.', $fields);
             
            foreach ($fields as $field) {
                
                // Strip brackets
                $field = substr($field, 1, strlen($field) - 2);
                // Split the options for this field
                $fieldVals = explode('|', $field);
                                
                foreach ($fieldVals as $fieldVal) {
                    if (!empty($fieldVal)) {
                        // Split name and value
                        list($key, $value) = explode(':', $fieldVal);
                        // If a grouped filter item
                        if (array_key_exists($key, $this->filterGroups)) {
                            // Value will hold group item values separated by semi-colons
                            $groupVals = explode(';', $value);            
                            for ($i = 0; $i < count($groupVals); $i++) {  
                                for ($j = 0; $j < count($this->filterGroups[$key]['fields']); $j++) {
                                    // Set to true if it is a legitimate option
                                    if (isset($this->filterOptions[ $this->filterGroups[$key]['fields'][$j] ]['values'][ $groupVals[$i] ])) {
                                        $this->filterOptions[ $this->filterGroups[$key]['fields'][$j] ]['values'][ $groupVals[$i] ]['val'] = 1;
                                        //echo '<div style="position:absolute">filter option:'.$key.'</div>';   
                                    }
                                }
                            }
                        } else {                        
                            // Set to true if it is a legitimate option
                            if (isset($this->filterOptions[$key]['values'][$value])) {
                                $this->filterOptions[$key]['values'][$value]['val'] = 1;
                            }
                            
                        }
                    }
                }
            }
            
        // Values may be posted as a different GET string (using the FILTER options)
        } else {
            
            // Check form posts
            foreach ($this->filterOptions as $optionName => $optionDetails) {
                    
                if ($optionDetails['type'] == 'select' || $optionDetails['type'] == 'radio') {
                
                    if (isset($_GET[$optionName]) && array_key_exists($_GET[$optionName], $optionDetails['values'])) {
                        $this->filterOptions[$optionName]['values'][$_GET[$optionName]]['val'] = 1;
                    } else {
                        // Check for a default value and use that if exists
                        foreach ($optionDetails['values'] as $valueName => $valueDetails) {
                            if (isset($valueDetails['default'])) {
                                $this->filterOptions[$optionName]['values'][$valueName]['val'] = 1;
                            }
                        }
                    }
                
                } else if ($optionDetails['type'] == 'check') {
                        
                    foreach ($optionDetails['values'] as $valueName => $valueDetails) {
                        if (isset($_GET[$optionName.':'.$valueName])) {
                            $this->filterOptions[$optionName]['values'][$valueName]['val'] = 1;
                        }
                    }
                    
                } else { // type == 'text'
                    continue;
                }
            }
        }
        
    }
    
    public function tabContentClasses($tabs, $spks) {
        
        $classes = '';
        if (!empty($tabs)) {
            foreach ($tabs as $tab) {
                $classes .= $tab.'-content ';
            }
        }
        if (!empty($spks)) {
            foreach ($spks as $spkType) {
                $classes .= $spkType.'-content ';
            }
        }
        return $classes;
    }
    
    // Print the Filter options based on the values set in $this->filterOptions
    public function printFilterOptions($search_type) {

        $clusterBoxHTML = '';
        $bussDiscSel = '';
        $artsDiscSel = '';
        $prepLvlSel = '';
        $ugLvlSel = '';
        $honoursLvlSel = '';
        $pgcLvlSel = '';
        $pgrLvlSel = '';
        $collapsibleStarted = false;
      
        $intClass = (($this->intDomSelection == 'INT-ON') || ($this->intDomSelection == 'INT-OFF')) ? ' active-tab' : '';
        $domClass = ($this->intDomSelection == 'DOM') ? ' active-tab' : '';     

        $clusterBoxHTML .= '
        <div id="filtering-sidebar">
            <div id="filtering">
            '.$this->searchForm($search_type).'
            '; 
        
        foreach ($this->filterOptions as $optionName => $optionDetails) {

            // If not the right sort of field based on tab selection, continue as well
            if (!in_array($search_type, $optionDetails['spks'])) {
                continue;
            }
            
            $sel = '';
            $selectNotes = '';
            $collapsibleClass = ($optionDetails['collapsible']) ? 'ui-collapse' : '';
            if ($optionDetails['collapsible'] && !$collapsibleStarted) {
                $collapsibleStarted = true;
                $clusterBoxHTML .= '
                <div id="advanced-search-link" class="filter-option">
                    <a href=""><span class="plus">+</span><span class="minus">-</span> Advanced options</a>
                </div>
                <div id="advanced-opts">';
            }   

            $clusterBoxHTML .= '
            <div class="filter-option '.self::tabContentClasses($optionDetails['tabs'], $optionDetails['spks']).'" id="'.$optionName.'-cont">';
            
            if ($optionDetails['type'] == 'select') {
                
                $selectNotes = '';
                $selectHTML = '';
                $selectHTML .= '
                  <select class="filter" id="'.str_replace('courses%2E', '', $optionName).'" name="'.$optionName.'">';
            
                $selectionMade = false;
                foreach ($optionDetails['values'] as $valueName => $valueDetails) {
                    if ($valueDetails['val']) {
                        $selectionMade = true;
                    }
                }
                    
                foreach ($optionDetails['values'] as $valueName => $valueDetails) {
                        
                        //$sel = ($valueDetails['val']) ? ' selected' : '';
                    $sel = '';
                        //$class = (isset($valueDetails['default']) && !empty($valueDetails['default'])) ? ' default-opt' : '';
                    if ($selectionMade) {
                        $sel = ($valueDetails['val']) ? ' selected' : '';
                    } else if (isset($valueDetails['default']) && !empty($valueDetails['default'])) {
                        $sel = ' selected';
                    }
                    if ($valueName == 'NOTE') {
                        $selectNotes .= '
                        <span class="filter-pnl-note">'.$valueDetails['printName'].'</span>';
                    } else {
                        $selectHTML .= '
                    <option value="'.$valueName.'"'.$sel.'>'.$valueDetails['printName'].'</option>';
                    }
                }
                
                $selectHTML .= '
                  </select>';

                $clusterBoxHTML .= '
                <h3 class="'.$collapsibleClass.'"><span class="ui-icon"></span>'.$optionDetails['title'].'</h3>
                <div class="filter-pnl">
                  '.$selectNotes.'
                  '.$selectHTML.'
                </div>';
            
            } else if ($optionDetails['type'] == 'radio') {
            
                $clusterBoxHTML .= '
                <h3 class="'.$collapsibleClass.'"><span class="ui-icon"></span>'.$optionDetails['title'].'</h3>
                <div class="filter-pnl">';
            
                $selectionMade = false;
                foreach ($optionDetails['values'] as $valueName => $valueDetails) {
                    if ($valueDetails['val']) {
                        $selectionMade = true;
                    }
                }
                
                foreach ($optionDetails['values'] as $valueName => $valueDetails) {
                    $sel = '';
                    $class = (isset($valueDetails['default']) && !empty($valueDetails['default'])) ? ' default-opt' : '';
                    if ($selectionMade) {
                        $sel = ($valueDetails['val']) ? ' checked' : '';
                    } else if (isset($valueDetails['default']) && !empty($valueDetails['default'])) {
                        $sel = ' checked';
                    }
                    if ($valueName == 'NOTE') {
                        $clusterBoxHTML .= '
                        <span class="filter-pnl-note">'.$valueDetails['printName'].'</span>';
                    } else {
                        $clusterBoxHTML .= '
                        <span class="filter-choice">
                            <input class="filter'.$class.'" type="radio" id="'.str_replace('courses%2E', '', $optionName).'-'.$valueName.'" name="'.$optionName.'" value="'.$valueName.'"'.$sel.'>
                            <label for="'.str_replace('courses%2E', '', $optionName).'-'.$valueName.'">'.$valueDetails['printName'].'</label>
                        </span>';
                    }
                }
                $clusterBoxHTML .= '
                </div>';
                
            } else if ($optionDetails['type'] == 'check') {
            
                $customClass = (isset($optionDetails['customClass'])) ? $optionDetails['customClass'] : '';
                
                $clusterBoxHTML .= '
                <h3 class="'.$collapsibleClass.' ' . $customClass . '"><span class="ui-icon"></span>'.$optionDetails['title'].'</h3>
                <div class="filter-pnl">';
                
                foreach ($optionDetails['values'] as $valueName => $valueDetails) {             
                                        
                    $sel = ($valueDetails['val']) ? ' checked' : '';
                    if ($valueName == 'NOTE') {
                        $clusterBoxHTML .= '
                        <span class="filter-pnl-note">'.$valueDetails['printName'].'</span>';
                    } else {                        
                        //remove unwanted meta data for GSA interpolation
                        $parsedOptionName = preg_replace('!courses%2E|offshore-!', '', $optionName);
                        
                        $clusterBoxHTML .= '
                        <span class="filter-choice ' . $customClass . '">
                            <input class="filter" type="checkbox" id="'.$parsedOptionName.':'.$valueName.'" name="'.$optionName.':'.$valueName.'" value="'.$valueName.'"'.$sel.'>
                            <label for="'.$parsedOptionName.':'.$valueName.'">'.$valueDetails['printName'].'</label>
                        </span>';
                    }
                }
                $clusterBoxHTML .= '
                </div>';
                
            } else if ($optionDetails['type'] == 'text') {
                
                $clusterBoxHTML .= '<div class="filter-note">'.$optionDetails['title'].'</div>';
                
            } // else unsupported.
            
            $clusterBoxHTML .= '
            </div>';
            
        }

        $closeDiv = ($collapsibleStarted) ? '</div>' : '';

        $clusterBoxHTML .= '
          <input type="submit" id="filter-btn" name="filter" value="Search '.$search_type.'s" />
          <input type="reset" id="clear-btn" name="clear" value="Clear filters" style="display: none;" />
          '.$closeDiv.'
          </div>
        </div>';
        
        return $clusterBoxHTML;
    
    }
    
    private function hasComplexFilterAffix($val) {
        return array_key_exists($val, $this->complexFilters);
    }
    
    private function getValueRemap($valArray) {
        $remap = '';
        
        foreach ($valArray as $value) {
            if (!array_key_exists($value, $this->filterRemaps['values'])) {
                continue;
            } else {
                return $this->filterRemaps['values'][$value];
            }
        }
        return $remap;      
    }
    
    // Set the value for $this->partialfields based on the values set in $this->filterOptions
    private function setPartialFields() {
//      echo '<pre>';
        $partialFields = '';
        $groupPartialFields = '';
        $val_selected = '';
        $val_default = '';
        $optionsSelected = array();
        $groupSelections = array();
        $partialRemapSelections = array();
        // Do groups first
        foreach ($this->filterGroups as $groupName => $groupDets) {

            unset($groupSelections);
            $groupPartialFields = '';

//echo '<!--intdomselection:'.$this->intDomSelection.' searchTupe'.$this->searchType.'-->';

            // If not the right sort of field based on tab selection, continue as well
            if (!in_array($this->intDomSelection, $groupDets['tabs']) || !in_array($this->searchType, $groupDets['spks'])) {
                continue;
            }
            foreach ($groupDets['fields'] as $groupedField) {

                $this->filterOptions[$groupedField]['grouped'] = true;
                foreach ($this->filterOptions[$groupedField]['values'] as $valueName => $valueDetails) {
                    // Check what has been selected
//                  'courses%2Eint-avail-combo' => array('fields' => array('offshore-location', 'session'), 'tabs' => array('COMPLEX-OFFSH'), 'spks' => array('course', 'unit'), 'code-exception' => array('NZ' => 'courses%2Eavail-combo'))
                    if ($valueDetails['val']) {//  && !empty($valueName)) {
                        //does a value have an OR operator SDA-2672
                        if (preg_match('![\|]!', $valueName)) {
                            $nestedQ = explode('|', $valueName);
                            foreach($nestedQ as $nestedValue) {
                                    $groupSelections[$groupedField][] = $nestedValue;                               
                            }       
                        } else {
                            $groupSelections[$groupedField][] = $valueName;
                        }
                        
                    }
                    
                }
                
//                if (empty($groupSelections[$groupedField])) {
//                    $groupSelections[$groupedField][] = 'XX';
//                }
                
            }

//             var_dump($groupSelections);
//             var_dump($partialExceptionSelections);
            // Create search strings for grouped fields
            if (!empty($groupSelections)) {
                $groupPartialFields = self::setGroupPartialFields($groupName, $groupSelections);
                $partialFields .= (empty($groupPartialFields)) ? '' : '('.$groupPartialFields.').';
            }
                                    
        }

//echo '<div style="position:absolute">partial:'.$partialFields.'</div>';
        foreach ($this->filterOptions as $optionName => $optionDetails) {
            
            if (isset($optionDetails['grouped'])) {
                continue;
            }
                        
            // If not the right sort of field based on tab selection, continue as well
            if (!in_array($this->intDomSelection, $optionDetails['tabs']) || !in_array($this->searchType, $optionDetails['spks'])) {
                continue;
            }
            
            unset($optionsSelected);
            unset($val_selected);
            unset($val_default);
            foreach ($optionDetails['values'] as $valueName => $valueDetails) {
                // Check what has been selected
                if ($valueDetails['val']) { // && !empty($valueName)) {
                    if (self::hasComplexFilterAffix($valueName)) {
                        $partialFields .= $this->complexFilters[$valueName]['val'] . '.';
                    } else if (preg_match('![\|]!', $valueName)) {
                            $nestedQ = explode('|', $valueName);
                            foreach($nestedQ as $nestedValue) {
                                $optionsSelected[] = $nestedValue;
                        }       
                    } else {
                        $optionsSelected[] = $valueName;
                    }
//                     $optionsSelected[] = $valueName;
                    $val_selected = $valueName;
                }
                
                // Check if there is a default
                if (isset($valueDetails['default'])) {
                    $val_default = $valueName;
                }
                
            }

            if (empty($optionsSelected) && !empty($val_default) && !self::hasComplexFilterAffix($valueName)) {
                $optionsSelected[] = $val_default;
            }
            if (!empty($optionsSelected)) {
                $partialFields .= '(';
                foreach ($optionsSelected as $valueName) {
                    $partialFields .= $optionName.':'.$valueName.'|';
                } 
                //remove the last or operator
                $partialFields = substr($partialFields, 0, -1);
                $partialFields .= ').';
                    
            }
            
        }        
        
        //remove the last and operator
        $partialFields = substr($partialFields, 0, -1);        
        $this->partialfields = $partialFields;
        
    }
    
    
    // Accepts name of group and all values selected (grouped by field name). need to produce a string containing all permutations of selected values, in order
    private function setGroupPartialFields($groupName, $groupSelections) {
        
        $partialFields = '';
        
        // check what has been selected for each groupItem and set values for each permutation
        $perms = self::factor_permutations($groupSelections);
        
//        echo '<pre>';
//       // print_r($groupSelections);
//        print_r($perms);
//        echo '</pre>';
        
//        $goodPerm = true;
        
//        if (count($perms) == 1) {
//            $goodPerm = false;
//            foreach ($perms[0] as $perm) {
//                if ($perm != 'XX') {
//                    $goodPerm = true;
//                }
//            }
//        }
         
//        if ($goodPerm) {
            
            // create a partialfields search string
            foreach ($perms as $combo) {
                $groupNameRemap = self::getValueRemap($combo);
                $groupName = !empty($groupNameRemap) ? $groupNameRemap : $groupName;
                $partialFields .= $groupName.':'.implode(';', $combo).'|';
            }
            $partialFields = substr($partialFields, 0, -1);
            
            return $partialFields;
        
//        }
        
        return '';
        
    }
    
    private function factor_permutations($lists) {

        $permutations = array();
        $iter = 0;
    
        while (true) {
    
            $num = $iter++;
            $pick = array();
    
            foreach ($lists as $l) {
                $r = $num % count($l);
                $num = ($num - $r) / count($l);
                $pick[] = $l[$r];
            }
    
            if ($num > 0) break;
            $permutations[] = $pick;
        }
    
        return $permutations;
    }
    
    private function setIntDomType() {
        
        if (isset($_GET['partialfields'])) {
            preg_match_all('!dom-int-intakes:(\w+-\w+)!', $_GET['partialfields'], $intDomMatches);
        }
        
        if (isset($_GET['courses%2Edom-int-intakes']) && !empty($_GET['courses%2Edom-int-intakes'])) {
            $this->intDomSelection = $_GET['courses%2Edom-int-intakes'];
        } else if (isset($intDomMatches[0][1])) {
            $this->intDomSelection = $intDomMatches[0][1] == 'INT-OFF' ? 'OFFSHORE' : $intDomMatches[0][1];
        } else {
            $this->intDomSelection = 'DOM';
        }
        
        //echo '!!!';
        //echo (isset($_GET['courses%2Edom-int-intakes']) && !empty($_GET['courses%2Edom-int-intakes'])) ? '*'.$_GET['courses%2Edom-int-intakes'].'*' : 'DOM';
    }
    
    private function setSearchType() {
        
        if (isset($_GET['search-type']) && !empty($_GET['search-type'])) {
            $this->searchType = ($_GET['search-type'] == 'unit') ? 'unit' : 'course';
        } else if (isset($_GET['site'])) {
            $this->searchType = ($_GET['site'] == 'squiz-units') ? 'unit' : 'course';
        }
        
        $this->site = ($this->searchType == 'unit') ? 'squiz-units' : 'squiz-courses';        
        
    }
    
    public function query($query=NULL, $allow_empty=TRUE)
    {
        
        if (empty($query)) {
            if (!empty($_GET['q'])) {
                $query=$_GET['q'];
            } else if (!empty($_GET['as_q'])) {
                $query=$_GET['as_q'];
            } else if (!empty($_GET['as_lq'])) {
                $query=$_GET['as_lq'];
            } else {
                $query = '';
            }
        }
        
        if ($this->output != 'xml') {
            
            self::setIntDomType();
            self::setSearchType();
            self::convertGetParams();
            self::setPartialFields();
            
        }
            
        $result = parent::query($query, $allow_empty);
        $result = str_replace('ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¦ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦ÃƒÂ¢Ã¢â€šÂ¬Ã…â€œÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã¢â‚¬Å“', '&#10003;', $result);
        
//            echo '<pre>';
//            echo $result;
//            echo '</pre>';
//          
        return $result;
    }
}
?>
