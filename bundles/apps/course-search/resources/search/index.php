<?php
// Open the file using the HTTP headers set above
//require config script
require_once('/var/www/search/lib/config.php');
require_once(LDAP_FUNCTIONS);
require_once(LDAP_AUTH);
require_once(HTMLAWED);
require_once(SEARCH_SCRIPT);

$valid_skins = array('exemplars');
$skin = $_REQUEST['GSA-skin'];

//create BOOTSTRAP_SCRIPT constant
defineBootstrap($skin, $valid_skins);
require_once(BOOTSTRAP_SCRIPT);

$_GET['q'] = htmLawed($_GET['q'], array('safe'=>1));
$_GET['as_q'] = htmLawed($_GET['as_q'], array('safe'=>1));
$_GET['as_lq'] = htmLawed($_GET['as_lq'], array('safe'=>1));
$_REQUEST['q'] = htmLawed($_REQUEST['q'], array('safe'=>1));
$_REQUEST['as_q'] = htmLawed($_REQUEST['as_q'], array('safe'=>1));
$_REQUEST['as_lq'] = htmLawed($_REQUEST['as_lq'], array('safe'=>1));


$search = new scu_search;
$role = $search->get_users_role();

if (!empty($skin)) {
	$search->show_collections = false;
}

//Do not output the header if it is a query to a cached page.
//q may not be set, so supress the error.
if (!stristr(@$_GET['q'],'cache:')) {
	scu_bootstrap::header($search);
}

/**
 * This section will output the body of the search and deal with
 * the performing of any searches that may have been submitted.
 */
if (empty($_GET['q']) && empty($_GET['as_q']) && empty($_GET['as_lq'])  && empty($_GET['as_filetype']) // Others?
	&& (empty($_GET['proxycustom']) || $_GET['proxycustom'] != '<ADVANCED/>')) {
	
	print scu_bootstrap::welcome_msg($search, $role); 
	
} 
//Do not output the footer if it is a query to a cached page.
//q may not be set, so supress the error.
if (!stristr(@$_GET['q'],'cache:')) {
	scu_bootstrap::footer();
}
?>