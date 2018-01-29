<?php

// *********************************************************
// change template call to use ENV_DOMAIN
// *** done but revoked, still need to do, but page may be 7 in dev, 5 in UAT and PRD, will use
// *********************************************************
// *********************************************************
// *********************************************************

include_once('/var/www/php/env_vars/env_vars.php');
include_once('/var/www/php/classes/nodes.core.php');

/**
 * SCU Bootstapper.
 *
 * Replace portions of this code commented with ~~~[SECTION TITLE]~~~
 */
class scu_bootstrap
{

	static function landingContentTiles($search_type, $award_level) {
		$path = RESOURCES_DIR;

		switch($search_type) {
			case 'unit': 	$path .= 'units/';
							break;
			case 'course':
			default:	 	$path .= 'courses/';
							break;
		}

		switch($award_level) {
			case 'PG':		$path .= 'pg.html';
							break;
			case 'HON':		$path .= 'hon.html';
							break;
			case 'PREP':	$path .= 'prep.html';
							break;
			case 'UG':
			default:		$path .= 'ug.html';
							break;
		}

		return file_get_contents($path);

	}

	static function relatedLinks() {
		$path = RESOURCES_DIR.'related-links.html';

		$html = '
			    <h3>Related links</h3>
			    '.file_get_contents($path);
		return $html;

	}

	static function noJsWarning($url_info) {

		if (!isset($_SERVER['HTTP_REFERER']) || strstr($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'].$url_info['path']) === false) {
			print '
			<noscript class="banner-msg"><p>It appears that you might have Javascript disabled in your browser. If you have arrived here via an email or web link it may not show the results you expect. Use the filter options and keyword to find what you are looking for.</p></noscript>';
		}

		print '
			<noscript><style>.main-content #landing-content { display: block; }</style></noscript>';

	}

	static function removeRemoteDependents($contents) {
		$contents = str_replace('%app_resources%', SCU_RESOURCES_DIR, $contents);
		//if its loaded from squiz, parse squiz dependencies
		$contents = str_replace('/__data/assets/image/0008/58715/backIcon.png', EXTERNAL_IMG_DIR . '/backIcon.png', $contents);
		$contents = str_replace('/__data/assets/image/0004/58747/backIcon@2x.png', EXTERNAL_IMG_DIR . '/backIcon@2x.png', $contents);
		$contents = str_replace('/__data/assets/image/0004/598/loading.gif', EXTERNAL_IMG_DIR . '/loading.gif', $contents);
		return $contents;
	}
	static function header($is_a_search, $search_type, $url_info)
	{
		
		$head = self::findLocalCopy(APP_TEMPLATE_DIR . '/header.html', 'http://'.ENV_DOMAIN.'/application-templates/index.php/util?util=template&part=header&template=1057&page=7');
		
		$enquiryCssContents = self::findLocalCopy(CRMLOADER_DIR . '/css/enquiries.css', 'http://' . ENV_SQUIZ_DOMAIN. '/__data/assets/css_file/0004/57082/enquiries.css?v=0.1.48');
		$enquiryCssContents = self::removeRemoteDependents($enquiryCssContents);
		
		$nodes = new nodes();
		$nodes->setXpathSchema(array('//style'));
		$nodes->getNodeFromHTML($head);
		$htmlFlat = $nodes->normaliser->getHtmlFlat();
		
		//we are using an xpath schema, which adds a further tier in the object
		//for each schema key it will be xpath_i, zero based
		if (!empty($nodes->html->{'xpath_0'})) {
			//these are style nodes found so just get first node as anchor
			$innerHtml = $nodes->html->{'xpath_0'}->{'node_0'};
			$htmlFlat = str_replace($innerHtml, $innerHtml . self::stringToCSS($enquiryCssContents), $htmlFlat);
		}
		$head = $nodes->normaliser->inflateHtml($htmlFlat);
		
		$search_btn_temp = '<a href="http://search.'.ENV_DOMAIN.'/[[SEARCH_TYPE]]s/" class="button-link" id="course-search-link" title="Search SCU [[UC_SEARCH_TYPE]]s" onclick="_gaq.push([\'_trackEvent\', \'[[UC_SEARCH_TYPE]]Search\', \'HeaderButton\', \'Search[[UC_SEARCH_TYPE]]\', 0, true]);">Search [[UC_SEARCH_TYPE]]s</a>';
		$search_course_btn = str_replace('[[SEARCH_TYPE]]', 'course',  str_replace('[[UC_SEARCH_TYPE]]', 'Course', $search_btn_temp));
		$search_unit_btn = str_replace('[[SEARCH_TYPE]]', 'unit', str_replace('[[UC_SEARCH_TYPE]]', 'Unit', $search_btn_temp));
		

		$askBtn = '<div id="top-buttons"><a href="http://'.ENV_DOMAIN.'/futurestudents/index.php/13" class="button-link" id="askQuestion" onclick="_gaq.push([\'_trackEvent\', \''.ucwords($search_type).'Search\', \'HeaderButton\', \'AskAQuestion\', 0, true]);">Ask a Question</a>' . $search_course_btn . $search_unit_btn . '</div>';
		//$searchcrumbs = ($is_a_search) ? '<a href="'.$url_info['path'].'">Find a '.$search_type.'</a> &gt; <span>Search results</span>' : '<span>Find a '.$search_type.'</span>';
		$breadcrumbs = '
<p id="search-crumbs" class="breadcrumbs" style="display: none">
<a href="http://'.ENV_DOMAIN.'/">Home</a>  &gt;  <a href="http://'.ENV_DOMAIN.'/futurestudents">Future Students</a>  &gt;  <a href="'.$url_info['path'].'">Find a '.$search_type.'</a> &gt; <span>Search results</span>
</p>
<p id="landing-crumbs" class="breadcrumbs">
<a href="http://'.ENV_DOMAIN.'/">Home</a>  &gt;  <a href="http://'.ENV_DOMAIN.'/futurestudents">Future Students</a>  &gt;  <span>Find a '.$search_type.'</span>
</p>';
		// Bastardisation
//$head = str_replace('<meta http-equiv="X-UA-Compatible" content="IE=8" />', '', $head);
//$head = str_replace('<meta http-equiv="cleartype" content="on">
//<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">', '', $head);
		$head = preg_replace('!<p\s+class="breadcrumbs".*?</p>!s', $breadcrumbs, $head);
        $head = preg_replace('!<h1>(.*?)</h1>!', '<h1 class="course-title">$1</h1>'.$askBtn, $head);
		if ($search_type == 'unit') {
			$head = preg_replace('!(<title>.*?)Course(.*?</title>)!', '$1Unit$2', $head);
			$head = preg_replace('!(<h1.*?>.*?)course(.*?</h1>)!', '$1unit$2', $head);
		}
		print $head;

		print self::noJsWarning($url_info);

	}

	static function landingContent($search_type) {
		$html = '
			<div id="course-content" class="bbq course-content">
			  <input type="hidden" name="num" id="fake-num" value="10"/>
			  <div id="course-content-tabs" class="bbq-nav bbq-nav2 search-landing-tabs">
			    <a href="#undergrad" class="bbq-link bbq-current" onclick="_gaq.push([\'_trackEvent\', \''.ucwords($search_type).'Search\', \'TabClick\', \'Undergraduate\', 0, true]);">Undergraduate</a>
			    <a href="#postgrad" class="bbq-link" onclick="_gaq.push([\'_trackEvent\', \''.ucwords($search_type).'Search\', \'TabClick\', \'Postgraduate\', 0, true]);">Postgraduate</a>';

		if ($search_type == 'course') {
			$html .= '
			    <a href="#honours" class="bbq-link" onclick="_gaq.push([\'_trackEvent\', \''.ucwords($search_type).'Search\', \'TabClick\', \'Honours\', 0, true]);">Honours</a>';
		}

		$html .= '
			    <a href="#preparation" class="bbq-link" onclick="_gaq.push([\'_trackEvent\', \''.ucwords($search_type).'Search\', \'TabClick\', \'Preparation\', 0, true]);">Preparation</a>
			  </div>
			  <div class="bbq-content">
			    <div id="undergrad" class="bbq-item bbq-default tab-cont">
		          '.self::landingContentTiles($search_type, 'UG').'
				</div>
			    <div id="postgrad" class="bbq-item tab-cont">
		          '.self::landingContentTiles($search_type, 'PG').'
				</div>';

		if ($search_type == 'course') {
			$html .= '
			    <div id="honours" class="bbq-item tab-cont">
		          '.self::landingContentTiles($search_type, 'HON').'
				</div>';
		}

		$html .= '
			    <div id="preparation" class="bbq-item tab-cont">
		          '.self::landingContentTiles($search_type, 'PREP').'
				</div>
			  </div>
			</div>';
		return $html;
	}

	static function searchContent($result) {
		$html = '
			<div id="course-content" class="course-content">
			  <div id="course-content-tabs" class="bbq-nav search-results-tabs">
			    <a class="bbq-current">Search results</a>
			  </div>
			  <div class="bbq-content">
			    <div id="results" class="bbq-item bbq-default">
		          <div id="results-cont">'.$result.'</div>
				</div>
			  </div>
			</div>';
		return $html;
	}

	static function body($is_a_search, $search_type, $filter_id, $filter_opts, $result)
	{

		print '
		<form id="GSA-search-form" method="get" action="" class="'.$search_type.'-search-form">
		  <div id="GSA-results">
		    <div id="site-nav-cont">
		  	  <div class="bbq-nav search-filter-tabs">
		  	    <a class="bbq-current">Search options</a>
		  	  </div>
		  	  <div class="sidebar-module filtering-module">
				<input type="hidden" name="search-type" id="search-type" value="'.$search_type.'"/>';

		if ($search_type == 'unit') {
			print '
				<input type="hidden" name="courses%2Edom-int-intakes" value="DOM"/>';
		}

		print '
		  	    <div id="'.$filter_id.'">'.$filter_opts.'</div>
		  	  </div>
			  <div id="related-links" class="sidebar-module upper-nav">
				'.self::relatedLinks().'
			  </div>
		    </div>';

		if ($is_a_search) {
			print '<div id="search-content">'.self::searchContent($result).'</div>';
		} else {
			print '<div id="landing-content">'.self::landingContent($search_type).'</div>';
			print '<div id="search-content" style="display: none;">'.self::searchContent($result).'</div>';
		}

		print '
			  <div id="lower-related-links" class="sidebar-module lower-nav">
			    '.self::relatedLinks().'
			  </div>
		  </div>
		</form>
		<form action="" method="post">
			<input type="hidden" name="last-search" id="last-search" value=""/>
		</form>';
	}

	static function stringToScript($contents) {
		return '<script type="text/javascript">' . $contents . '</script>';
	}
	
	static function stringToCSS($contents) {
		return '<style>' . $contents . '</style>';
	}
	
	static function findLocalCopy($path, $externalUrl) {
		if (file_exists($path)) {
			return file_get_contents($path);
		} else {
			return file_get_contents($externalUrl);
		}
	}
	
	static function footer()
	{
		$ini = parse_ini_file("gsa.ini");
        $crmLoaderSrc = (string) (isset($ini['crm-loader-src'])) ? $ini['crm-loader-src'] : 'http://' . ENV_DOMAIN . '/__data/assets/js_file/0004/59170/crm-form.js';
		
		$foot = self::findLocalCopy(RESOURCES_DIR . 'crm-enquiry-form.html','http://' . ENV_SQUIZ_DOMAIN . '/snippets/forms/crm-enquiry-form-container') .'<div class="shade"></div>';
		$foot .= self::findLocalCopy(APP_TEMPLATE_DIR . '/footer.html', 'http://'.ENV_DOMAIN.'/application-templates/index.php/util?util=template&part=footer&template=1057&page=7');
		$foot = preg_replace('!copy-title"\>.!', 'copy-title">&copy;', $foot);
		$foot .= self::stringToScript(self::findLocalCopy(CRMLOADER_DIR .'/js/crm-form.js', $crmLoaderSrc));		
		$foot .= self::stringToScript(self::findLocalCopy(CRMLOADER_DIR .'/js/enquiries.js', 'http://' . ENV_SQUIZ_DOMAIN . '/__data/assets/js_file/0003/57081/enquiries.js?v=12'));
        
        print $foot;
	}
}
?>