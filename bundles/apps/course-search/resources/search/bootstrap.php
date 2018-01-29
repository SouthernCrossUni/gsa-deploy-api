<?php
/**
 * SCU Bootstapper.
 * 
 * Replace portions of this code commented with ~~~[SECTION TITLE]~~~
 */
class scu_bootstrap
{
	//Roles are public, staff and student.
	//const ROLE='public';
	
	
	static function welcome_msg($search_ob, $role) {
		
		switch($role) {
			case 'staff'		: $login_link = '<li>You are currently logged in as a <b>Staff Member</b> which will allow you to view protected documents.</li>';
								  break;
			case 'student'		: $login_link = '<li>You are currently logged in as a <b>Student</b> which will allow you to view some protected documents.</li>';
								  break;
			case 'public'		:
			default				: $login_link = '<li>You will need to <img src="/gfx/lock.png" style="margin-bottom: -3px;">&nbsp;<a href="http://study.scu.edu.au/search"><b>Login</b></a> to view protected documents and pages.</li>';
								  break;
		}
		
		$staff_dir_notice = '&nbsp;
		<input type="hidden" name="filter" value="0" />';
		
		$html .= self::suggest_code();
		
		return $html;
	}
	
	static function no_results_msg() {
		
		$html = '<p id="er">No Search Results to Display.</p>';
		
		$html .= self::suggest_code();
		
		return $html;
	}
	
	
	static function suggest_code() {
		
		$html = <<<HTML
	<style type="text/css">
	.ac-renderer {
	position : absolute;
	width : 300px;
	background-color : #FFF;
	border : 1px solid #999;
	z-index : 10000;
	}
	.ac-row {
	position : relative;
	background-color : #FFF;
	margin : 1px;
	padding : 1px 4px;
	cursor : pointer;
	}
	.ac-highlighted {
	color : #111;
	}
	.ac-active {
	background-color : #BAC9E0;
	color : #111;
	font-weight : bold;
	}
	</style>
	<script type="text/javascript" src="suggest_js.js"></script>
	<script type="text/javascript">
			window.setTimeout
			(
				function()
				{
					sgst('q');
					sgst('as_q');
				},
				1000
			)
	</script>
HTML;

		$html .= <<<HTML
		<style type="text/css" media="screen,print"><!--
/* <![CDATA[ */ 
html{font-size:76%}
h1,h2,h3,h4,h5,h6,form,fieldset,#nd,.sa,.sn,#su p,.s,.st,.fm,#sr,#km ul{margin:0;padding:0}
img,fieldset{border:0}
body,div{font-family:Arial,sans-serif;font-size:1em;color:#000}
/*body,.a,a:link,.f,.f:link,.f a:link,a:visited,.f a:visited,a:active,.f a:active{background:}*/
a:link{color:#00c}
a:visited,.f a:visited{color:#551a8b}
a:active,.f a:active{color:#f00}
#co{clear:both;padding:3em 0 1em 0;text-align:center;font-size:1.1em;color:#2f2f2f}
.bt{vertical-align:bottom}
.z,#sk,#ns span.sp,#n span.sp,#sf h2,#sb h2,#re h3,.rn,#nd span,.sn span{display:none}
hr{clear:both;width:100%;height:1%;overflow:auto;margin-top:1em}
#re{clear:none}
#nd{padding:4px 0 6px 0;font-size:1.1em}
#nd a{display:inline;list-style-type:none;margin-right:.75em}
#nd a:visited,#nd a:link,#nd a:active{color:#00c}
#su{clear:both;height:1%;overflow:auto;width:100%;margin-bottom:4px;padding:1px 0;background:#e5ecf9;border-top:1px solid #36c}
#su h2{float:left;font-size:1.5em;padding:0 2px}
#su p{float:right;font-size:1.1em;line-height:1.5em;padding:0 2px}
#ns{height:1%;overflow:auto;width:100%;clear:both}
#ns .np a:after{content:">"}
#ns .pp a:before{content:"<"}
#nt,#so{font-size:1.1em;padding:0 2px;margin:1px 0;display:inline}
#nt{float:left}
#nt a{margin-right:.75em}
#so{float:right}
#so strong{font-weight:normal}
#so a,#so strong{margin-left:.75em}
#re{clear:none}
#re dt,#re dd{margin-left:0}
#re dd{margin-bottom:1em}
#re dt.l2,#re dd.l2{margin-left:40px}
#re .st,#re .a,#re .a:link{color:#008000}
#re .st,#re .fm{font-size:1.05em}
#re .ft{font-size:.85em}
#re .f,#re .f:link,#re .f a:link{color:#77c}
#re .l{font-size:1.35em;color:#00c}
#re .s{font-size:1.05em}
#re .s2,#re .fm{display:block}
#om{font-size:1.3em;width:600px;}
#n{padding:1em 0 1.5em 0;font-size:1.15em}
#n h3,#n p,#n span,#n span a{margin:0;padding:0}
#n div.co{display:block;margin:0 auto}
#n h3{font-size:.95em;font-weight:normal;padding-right:.5em;vertical-align:bottom;white-space:nowrap}
#n p{display:block;text-align:center}
#n h3,#n span,#n span a,#n span strong{display:inline}
#n span a{color:#000}
#n span.np a,#n span.pp a{color:#00c}
#n span.cp strong{color:#a90a08}
.b,.b a{color:#00c;font-weight:bold}
#n .ln h3,#n .ln span a,#n .ln span strong,#n .ln span.fp strong,#n .ln span.pp a,#n .ln span.np a,#n .ln span.lp strong{width:auto;padding:0 4px}
/* ]]> */
--></style>

<style type="text/css" media="print"><!--
/* <![CDATA[ */
#sf,#sb,#n,#ns,#sy,p.fm,.st .rc,#om span,#sr span,#lg a,#lg span,#su .st,#nd{display:none}
#re dt+dd{page-break-inside:avoid}
a{text-decoration:none}
a:link,a:visited{color:#00c}
#lg:before{content:url("images/Title_Left.gif")}
/* ]]> */
--></style>
<!--[if lte IE 7]><style type="text/css" media="screen,print">
/*#n h3,#n span a,#n span strong{float:left}
div#n{position:relative;right:50%;float:right}
div.co{position:relative;left:50%;float:left}
#n span.sp{display:none}*/
</style><style type="text/css" media="print">
#lg{display:list-item;margin:0;padding:0;list-style-image:url("images/Title_Left.gif");list-style-position:inside;overflow:auto;height:1%}
#su{height:auto;overflow:visible}
</style><![endif]-->
<!--[if IE 7]><style type="text/css" media="screen,print">
#n .ln h3,#n .go h3{width:100%}
</style><![endif]-->

<style type="text/css" media="handheld">
/* <![CDATA[ */
/*body,.a,#sy,#ss,#sw,a:link,.f,.f:link,.f a:link,a:visited,.f a:visited,a:active,.f a:active{background:}*/
body{color:#000}
.a{color:#008000}
#sy{color:#c00}
#ss{color:#c00}
#sw{color:gray}
a:link{color:#00c}
.f,.f:link,.f a:link{color:#77c}
a:visited,.f a:visited{color:#551a8b}
a:active,.f a:active{color:#f00}
img,fieldset{border:0}
#lg a,#lg span{float:left;text-indent:-9999px;overflow:hidden;background:url("http://www.google.com/xhtml/images/google.gif") no-repeat;height:35px;width:85px}
#su h2:after,#km h3:after{content:":"}
#n .pp:after{content:", "}
dd .s:after{content:" - "}
#su,#om,#sr,#sf{clear:both}
.sa,p.fm{margin:0}
dd{margin-left:0;margin-bottom:1em}
h1{margin:0}
#su h2,#km h3,#km ul,#su p,.sn a,#co,fieldset{margin:0;padding:0}
#sf,#sf h2,#sb h2,#re h3,.sn span,#ns span,#sk,.s2,.sn .as,#nd,#su .st,#so strong,#n h3,#n span,.sa span{display:none}
#home #sf,#nt #so,#gs,#gs_f,dt,dd p.fm,#su h2,.sn a,.sa span.ac{display:block}
#n .pp,#n .np,dd p{display:inline}
.sn a{display:list-item}
#su h2,#km h3{font-size:1em}
#ns #so strong,dd strong,#su strong,dt .ft{font-weight:normal}
dt .rn{font-weight:bold}
.sn,#km ul{list-style:none}
.sa label{text-transform:capitalize}
#q, #q_f{width:10em}
/* ]]> */
</style>

HTML;
		
		return $html;
	}
	
	
	static function random_page_banner() {
		
		$inc_path = '/var/www/scu/includes/base/random_page_banners.php';
		
		// Store the include in the buffer so we can retrieve it as a variable
		ob_start();
		include($inc_path);
		$inc_data = ob_get_contents();
		ob_end_clean();

		// Sometime the buffer doesnt catch the data if it is returned as a variable, so check
		if(empty($inc_data)) {
			$inc_data = include($inc_path);
		}
		
		return $inc_data;
	}
	
	static function nav_bar() {
		
		$html = '
<div  style="padding:5px" class="nav_bar_main">
	<a href="http://www.scu.edu.au/">Home</a> | 
	<a href="http://www.scu.edu.au/courses/">Course Options</a> | 
	<a href="http://www.scu.edu.au/services/">A-Z of Services and Facilities</a> | 
	<a href="http://www.scu.edu.au/staffdirectory/">Online Staff Directory</a> | 
	<a href="http://www.scu.edu.au/contact/">Contact Us</a>
</div>';
		
		return $html;
	}
	
	static function header($search_ob)
	{				
	//<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
//"http://www.w3.org/TR/html4/loose.dtd">	

		print <<<HTML

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
<title>Southern Cross University, Australia - Search SCU</title>
<link rel=�shortcut icon� href=�http://www.scu.edu.au/favicon.ico� mce_href=�http://www.scu.edu.au/favicon.ico�/>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="description" content="SCU, an Australian government university committed to innovative teaching and research. Study business; arts; social sciences; paralegal studies; environmental science; nursing; preparation courses and more, on campus and by distance study." />
<meta name="keywords" content="SCU, midyear, mid-year, mid year, study online, distance ed, online studies, arts, business, health, applied science, human sciences, undergraduate, postgraduate, undergrad, postgrad, southern cross uni, southern cross university, paralegal, social sciences, environmental science, visual arts, visarts" />
<link rel="stylesheet" href="/public/search.css">
<meta name="viewport" content="width=808" />
<style>
-webkit-text-size-adjust: none;
</style>
<link media="only screen and (max-device-width: 480px)" href="/public/mobile.css" type="text/css" rel="stylesheet" />
    
</head>
<body id="body">
<div id="container">
	<header role="banner" class="clearfix">
		<div style="padding:10px 0px 10px 30px; background-color:#00539F" id="banner">
			<a href="http://www.scu.edu.au/"><img id="logo-lo" src="http://www.scu.edu.au/SCU-template/img/logo/SCU-Logo-Blue.png" alt="Southern Cross University"></a>
		</div>
	</header>
<div id="divitis">
<div id="page-title">
  <div style="position: relative; z-index: 2; font-family: Lucida Sans Unicode,Lucida Grande,sans-serif; font-size: 1.7em; font-weight: normal; color: rgb(255, 255, 255);  left: 440px;" id="header">Search SCU</div>
</div>

HTML;
	
		print self::nav_bar();
		
		print self::searchForm($search_ob, 'GSA-search-form');
		
	}
	
	static function footer()
	{
		include ("/var/www/php/classes/htmlGrabber.php");
		$url = 'http://' . ENV_WWW_DOMAIN;
		$xpath = '//span[@class="SCU-cricos"]';
		$grabber = new htmlGrabber();
		$snippet = $grabber->getXpathNode($url, $xpath);
		$cricos = $snippet[0]['raw_text'];

		include '/var/www/scu/includes/js/GA-tracking-code-1.php';
		print '
	<div class="footer">
		<footer role="contentinfo" class="clearfix">
			<div class="footer-shadow"></div>
			<p class="top-link"><a href="#">top</a></p>
			<p class="global-footer">
			<span class="SCU-copy-title">(c)<a href="http://www.scu.edu.au/">Southern Cross University</a></span><span class="sep titlesep"> | </span><a href="http://www.scu.edu.au/wwwadmin/disclaimer/">Legals</a><span class="sep"> | </span><a href="http://www.scu.edu.au/privacy/">Privacy</a><span class="sep"> | </span><a href="http://www.scu.edu.au/feedback/">Feedback</a><span class="sep"> | </span><a href="http://www.scu.edu.au/contact/">Contact Us</a><span class="admin-link"></span><span class="sep abnsep"> | </span><span class="SCU-abn">ABN: 41 995 651 524</span><span class="sep cricosep"> | </span><span class="SCU-cricos">' . $cricos . '</span>
			</p>
		</footer>
	</div>
	<script type="text/javascript">
	setTimeout(function(){var a=document.createElement("script");
	var b=document.getElementsByTagName("script")[0];
	a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0042/2827.js?"+Math.floor(new Date().getTime()/3600000);
	a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
	</script>
  </div>
  </div>
</body>
</html>';
		
	}
	
	static function searchForm($search_ob, $formid, $c = NULL, $extra_bits = '') {
				
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
			
			if (empty($c) && !empty($_REQUEST['c'])) {
				$c = $_REQUEST['c'];
			}
			
			if (empty($c) && !empty($_REQUEST['site'])) {
				
				$sites = explode('|', $_REQUEST['site']);
				
				$c = $search_ob->get_collection_nums($sites);
				
			}
		
			$site_field = (!empty($c) && !preg_match('![^0-9,]!', $c)) ? '<input type="hidden" name="c" value="'.$c.'" />' : '';
//			$as_link = empty($site_field) ? '<a href="?q='.((empty($q)) ? $aq : $q).'&amp;proxycustom=%3CADVANCED%2F%3E" class="as">&raquo;&nbsp;<span class="link">Advanced Search</span></a>' : '';
			$as_link = (empty($extra_bits)) ? '<a href="?q='.((empty($q)) ? $aq : $q).'&amp;c='.$c.'&amp;proxycustom=%3CADVANCED%2F%3E" class="as">&raquo;&nbsp;<span class="link">Advanced Search</span></a>' : '';
			
			//			$q=htmlspecialchars($q, ENT_QUOTES);
			$q=str_replace(array("'", '"'), array('&apos;', '&quot;'), $q);

			$html = '<div class="notice">
		<p>Public Seach SCU has moved <a href="//site-search.scu.edu.au">here</a>.You can still use the above text field to perform searches but you will be redirected to a new improved search interface.</p>
		</div>';
			$html .= '
<form id="'.$formid.'" method="get" action="//site-search.scu.edu.au/search">
	<input type="text" name="q" value="'.$q.'" id="GSA-search-input" maxlength="256" alt="Search Query" title="Enter search query" />
	<input type="submit" value="Search site" id="GSA-search-submit" />
	<input type="hidden" name="site" value="scu"/>
	<input type="hidden" name="client" value="scu_frontend"/>
	<input type="hidden" name="proxystylesheet" value="scu_frontend"/>
	'.$site_field.'
	'.$as_link.'
	'.$extra_bits.'
</form> 
<script type="text/javascript">document.getElementById(\'GSA-search-input\').focus();</script>';
			
			return $html;
			
		} else {
			return '';
		}
	}
} 
?>