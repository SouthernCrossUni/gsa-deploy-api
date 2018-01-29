<?php
define ('HTMLAWED', '/var/www/php/validation/htmLawed.php');
define ('COURSE_DIR', 'courses');
define ('UNIT_DIR', 'units');
define ('RESOURCES_DIR', '../snippets/');
define ('APP_TEMPLATE_DIR', '../template');
define ('SCU_RESOURCES_DIR', '../resources');
define ('EXTERNAL_IMG_DIR', APP_TEMPLATE_DIR . '/img');
define ('CRMLOADER_DIR', SCU_RESOURCES_DIR . '/plugins/crmloader');

require_once(HTMLAWED);
require_once('../'.COURSE_DIR.'/course-search.php');
require_once('../'.COURSE_DIR.'/course-bootstrap.php');


// ****************************************************************************************************************************************************
ini_set('display_errors',1);
error_reporting(E_ALL);
// ****************************************************************************************************************************************************

 // SEARCH
 // There is currently a dependance on squiz for the course-style.css and bbq.js (may not be a problem cos if squiz goes down results won't work anyway?)
 //   NEED TO BE AWARE URL COULD CHANGE IN SQUIZ
 // ADDED optional param to DBMST search. need to test with normal search.
 // INT-AVAIL-COMBO includes HK etc. This returns results based on session but they don't show in table? What should we show and what should we search on?
 // No placeholder on input atm, will need to use image way.
 // Need loading image while fetching results.

// NEED TO CHECK IF WE NEED TO FILTER DYNAMIC INPUTS.....
// Might need to loop through all $_GET and $_REQUEST params and do so...

$_GET['q'] 			= (isset($_GET['q'])) ? htmLawed($_GET['q'], array('safe'=>1)) : '';
$_GET['as_q'] 		= (isset($_GET['as_q'])) ? htmLawed($_GET['as_q'], array('safe'=>1)) : '';
$_GET['as_lq'] 		= (isset($_GET['as_lq'])) ? htmLawed($_GET['as_lq'], array('safe'=>1)) : '';
$_GET['ajax'] 		= (isset($_GET['ajax'])) ? htmLawed($_GET['ajax'], array('safe'=>1)) : '';
$_GET['site'] 		= (isset($_GET['site'])) ? htmLawed($_GET['site'], array('safe'=>1)) : '';
$_GET['search-type'] 		= (isset($_GET['search-type'])) ? htmLawed($_GET['search-type'], array('safe'=>1)) : '';
$_REQUEST['q'] 		= (isset($_REQUEST['q'])) ? htmLawed($_REQUEST['q'], array('safe'=>1)) : '';
$_REQUEST['as_q'] 	= (isset($_REQUEST['as_q'])) ? htmLawed($_REQUEST['as_q'], array('safe'=>1)) : '';
$_REQUEST['as_lq'] 	= (isset($_REQUEST['as_lq'])) ? htmLawed($_REQUEST['as_lq'], array('safe'=>1)) : '';
$_REQUEST['ajax'] 	= (isset($_REQUEST['ajax'])) ? htmLawed($_REQUEST['ajax'], array('safe'=>1)) : '';
$_REQUEST['site'] 	= (isset($_REQUEST['site'])) ? htmLawed($_REQUEST['site'], array('safe'=>1)) : '';
$_REQUEST['search-type'] 	= (isset($_REQUEST['search-type'])) ? htmLawed($_REQUEST['search-type'], array('safe'=>1)) : '';

$url_info = parse_url($_SERVER['REQUEST_URI']);

$search = new scu_search;

$is_ajax     = ($_GET['ajax']);
$is_a_search = (!empty($_GET['site']) || !empty($_GET['search-type']));
$search_type = (strstr($url_info['path'], COURSE_DIR) === false) ? 'unit' : 'course';
$result      = ($is_a_search) ? $search->query($_GET['q']) : '';
// $filter_id is used by JS to determine whether on results page or not. i.e. IT'S IMPORTANT, don't change
$filter_id   = ($is_a_search) ? 'search-filter' : 'landing-filter';
$filter_opts = (!$is_ajax)    ? $search->printFilterOptions($search_type) : '';

if ($is_ajax) {
	print $result;
	exit;
}
//if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '10.133.26.35') {
//echo '<div style="position:absolute">'.$url_info['path'].' :: '.$search_type.'</div>';
//}

scu_bootstrap::header($is_a_search, $search_type, $url_info);

scu_bootstrap::body($is_a_search, $search_type, $filter_id, $filter_opts, $result);

scu_bootstrap::footer();

?>