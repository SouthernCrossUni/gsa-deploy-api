<!DOCTYPE html>

<!--
320 and Up boilerplate extension
Author: Andy Clarke
Version: 0.9b
URL: http://stuffandnonsense.co.uk/projects/320andup
-->

<!--[if IEMobile 7]><html class="no-js iem7" lang="en"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>

<!--<meta charset="ISO-8859-1">-->

<title>SCU Course Search - SCU</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">

<!-- http://t.co/dKP3o1e -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<!-- For less capable mobile browsers
<link rel="stylesheet" media="handheld" href="css/handheld.css?v=1">  -->

<!-- Only want Nivo slider if width > 768 -->
<link rel="stylesheet" media="only screen and (min-width: 768px)" href="/resources/js/nivo/nivo-slider.css?v=1">
<!-- For all browsers -->
<link rel="stylesheet" media="screen" href="/SCU-template/css/style.css?v=3">
<link rel="stylesheet" media="screen" href="/SCU-template/css/search.css">
<link rel="stylesheet" media="print" href="/SCU-template/css/print.css?v=2">
<!-- For progressively larger displays -->
<link rel="stylesheet" media="only screen and (min-width: 480px)" href="/SCU-template/css/480.css?v=2">
<link rel="stylesheet" media="only screen and (min-width: 768px)" href="/SCU-template/css/768.css?v=2">
<link rel="stylesheet" media="only screen and (min-width: 992px)" href="/SCU-template/css/992.css?v=2">
<link rel="stylesheet" media="only screen and (min-width: 1382px)" href="/SCU-template/css/1382.css?v=1">

<!-- For Retina displays -->
<!--[if !(IE)]><!--><link rel="stylesheet" media="only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2)" href="/SCU-template/css/2x.css?v=1">
<!--  For Retina Devices Specific to 480 wide -->
<!--  <link rel="stylesheet" media="only screen and (max-device-width: 480px) and and (-webkit-min-device-pixel-ratio: 2)" href="///SCU-template/css/retina-480.css" />-->
<!--  For Retina Devices Specific to 1024 wide -->
<link rel="stylesheet" media="only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2)" href="/SCU-template/css/retina-1024.css" /><!--<![endif]-->



<!--[if lt IE 9]><link rel="stylesheet" media="only screen" href="/SCU-template/css/ie/ltIE9.css"><![endif]-->
<!--[if lt IE 7]><link rel="stylesheet" media="only screen" href="/SCU-template/css/ie/ltIE7.css"><![endif]-->
<!--[if IE 7 ]><link rel="stylesheet" media="only screen" href="/SCU-template/css/ie/IE7.css"><![endif]-->
<!--[if IE 8 ]><link rel="stylesheet" media="only screen" href="/SCU-template/css/ie/IE8.css"><![endif]-->
<!--[if IE 8 ]><link rel="stylesheet" media="print" href="/SCU-template/css/ie/IE8_print.css"><![endif]-->
<!--[if IEMobile 7]><link rel="stylesheet" media="only screen" href="/SCU-template/css/ie/IEMobile7.css"><![endif]-->
<!-- <link rel="stylesheet" href="http://courses.scu.edu.au/__data/assets/css_file/0011/1028/course-style.css?v=0.1.208"/> -->
<style>
.question-outage { background: url('./gfx/ask-question.png') no-repeat 6px 50% !important; }

/* Accordions  */
.unit-content .ui-accordion-header { clear: both; background-color: #f3f3f3; height: 28px; line-height: 28px; border-radius: 4px; border: 1px solid #dedede; margin: 10px 0 0 12px; text-indent: 10px; color: #666; font-size: 1.3em; font-weight: normal; cursor: pointer; }
.unit-content .ui-accordion-header .ui-icon,
div#filtering .ui-icon { background-position: -7px -15px; width: 24px; height: 20px; display: block; float: left; }
.unit-content .ui-accordion-header .ui-icon { position: relative; top: 4px; margin-left: 4px; }
.unit-content .accordion .ui-state-active .ui-icon,
div#filtering .ui-state-active .ui-icon { background-position: -7px -64px; }
.unit-content .ui-accordion-content { margin: 0 4%; background: #fafafa; border-radius: 0px 0px 20px 20px; border: 1px solid #efefef; }
#colorbox .accordion h3,
.course-content .accordion h3 { clear: left; background-position: 2px -3px; height: 46px; line-height: 46px; border-radius: 4px; border: 1px solid #dedede; margin: 18px 0 0; text-indent: 88px; color: #666; font-size: 1.4em; font-weight: normal; cursor: pointer; }
.course-content .accordion .ui-state-active, #colorbox .accordion .ui-state-active { background-position: 2px -52px; border-radius: 4px 4px 0 0; border-bottom-color: #efefef; }
.course-content .accordion .int-how-to-apply h3,
#colorbox .accordion .int-how-to-apply h3 { background-position: 2px -102px; }
.course-content .accordion .int-how-to-apply .ui-state-active,
#colorbox .accordion .int-how-to-apply .ui-state-active { background-position: 2px -152px; }
#colorbox .accordion { width: 736px; }
/*.course-content .ui-accordion-content { margin: 0 0 0 21px; }
#colorbox .ui-accordion-content { margin-top: 16px; }*/
.course-content .ui-accordion-content,
#colorbox .ui-accordion-content { border: 1px solid #dedede; border-top: none; margin: 0 0 22px 0; padding: 0 14px 0px; float: left; }

/* Squiz juice */
body, h1, h2, h3, h4, h5, h6 { font-family: Tahoma, Arial, sans-serif; }
h1, h2 { font-weight: normal; }
h1 { font-size: 2em; color: #004488 !important; margin-left: 8px; }
h1.course-title { margin-bottom: 22px; margin-left: 8px; margin-top: 5px; float: left; line-height: 36px; max-width: 99%; color: #004488; }
h1.course-title #course-title-qual { font-size: 0.55em; }
h1.course-title #course-title-qual { font-style: italic; }
#course-title-spacer { display: none; width: 1px; height: 40px; margin-bottom: 38px; float: left; }
#course-page h1 { margin: 0.75em 0 0 0; }
header { -moz-box-shadow: 0px 0px 10px #85a1c1; -webkit-box-shadow: 0px 0px 10px #85a1c1; box-shadow: 0px 0px 10px #85a1c1; }
header #head-nav { background: white; }
html .schoolpage #slider-cont { display: none; background-color: #fff; }
footer { clear: both; }
html .schoolpage .main-content { width: 100%; margin-top: 24px; margin-bottom: 36px; }
html .schoolpage .main-content #site-nav-cont { background-color: #ffffff; margin-right: 10px; width: 212px; margin-left: 10px; }
html .schoolpage .main-content h2 { border-bottom: none; padding-top: 0.4em; margin-top: 1.4em; margin-bottom: 0.4em; }
html .schoolpage .main-content h2.nojs-hdr { font-size: 1.8em; border-bottom: 1px dotted #CDCDCD; margin-bottom: -12px; }
html .schoolpage div.dom-how-to-apply h2, #colorbox div h2 { margin-top: 0.9em; }
html .schoolpage .main-content #site-nav-cont th { background: transparent; text-transform: none; padding: 0; letter-spacing: 0; font-family: inherit; }
#course-page { width: 100%; float: left; }
#course-content, html .schoolpage .main-content #site-nav-cont { float: left; width: 96%; margin-left: 2%; }
html .schoolpage .main-content #site-nav-cont { clear: left; }
#course-content { float: right; margin-left: 0; margin-right: 2%; margin-top: 4px; }
#top-buttons { margin: 0 16px 26px 16px; float: right; }
#top-buttons a:hover { border-color: #898989; }
#no-apply-text { margin-top: 1em; }
#discipline-img { display: none; overflow: hidden; margin: 12px 0; }
#upper-module, 
#testimonials-wrapper { display: none; }
.Under-Construction { background: #DBF18A; }
.syd-fee { white-space: nowrap; }
.schoolpage .main-content .req-list ol { list-style-type: lower-alpha; }
.schoolpage .main-content .req-list ol ol { list-style-type: lower-roman; }
.schoolpage .main-content .req-list ol ol ol { list-style-type: decimal; }
.schoolpage .main-content .req-list ol ol ol ol { list-style-type: lower-alpha; }

/* Forms */
#year-select-form { margin: -17px 0 5px 14px; color: #777; float: left; clear: left; width: 90%; }
#year-select-form select { border: none; color: #555; }
#year-select-form .separator { font-size: 1.5em; color: #D5D5D5; }
#year-select-form .ui-active { font-weight: bold; cursor: default; color: #004488; }
#year-select-form .ui-active:hover { text-decoration: none; }
#course-search-form { float: right; position: relative; display: inline; margin: -5px 3px 0 0; padding: 5px 0 8px; }
#course-search-form #search-input { width: 293px; vertical-align: middle; margin: 0 0 12px 0; padding: 0; text-indent: 8px; height: 34px; line-height: 20px; border: 1px solid #bcbcbc; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; background: #f9f9f9; }
#course-search-form #search-submit { position: absolute; z-index: 9000; top: 12px; right: 28px; vertical-align: middle; margin: 0 -20px 0 0; padding-top: 0; text-indent: -999em; text-transform: capitalize /* required for IE to respect indent */; width: 20px; height: 20px; border: none; cursor: pointer; }

/* Buttons */
.apply-hdr { clear: both; }
.apply-btns { float: right; clear: right; }
#colorbox .main-content { margin-top: 3px; }
.button-link { display: block; float: right; height: 32px; line-height: 32px; color: #1F5680 !important; width: 100%; text-indent: 37px; border-radius: 6px; margin: 0 0 4px 0; font-weight: bold; background-position: 8px 35%; border: 1px solid #bcbcbc; }
.button-link:hover { text-decoration: none; }
.apply-now-btn { text-indent: 44px; background-position: 12px 50%; }
#course-search-link { }
html .cssT1SmPwrProgressAction_NextButton { background-position: 0 -16px; display: block; border: medium none; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; color: white !important; font-family: Arial, Sans-Serif; font-size: 150%; font-weight: bold; height: 44px; padding: 0px; white-space: normal; width: 210px; line-height: 42px; text-decoration: none; text-align: center; margin-bottom: 12px; }
html .cssT1SmPwrProgressAction_NextButton:hover { background-position: 0px -93px; text-decoration: none; }

/* Notices */
.schoolpage p.course-notice, #colorbox p.course-notice, .schoolpage div.course-notice-cont { background-color: #F7E483; border: 1px solid #D3BF59; color: #372613; margin-top: -17px; margin-bottom: 26px; padding: 8px 5% 8px 42px; padding-right: 5%; width: 72%; font-weight: bold; font-style: italic; border-radius: 6px; margin-left: 5%; }
.schoolpage div.course-notice-cont p { font-weight: bold; font-style: italic; }
.schoolpage div.course-notice-cont { width: 84%; }
.schoolpage p.course-notice-light, #colorbox p.course-notice-light { background-image: none; background-color: #E7ECF0; border-color: #A9B5BE; color: #3E4144; }
.schoolpage #course-content p.course-notice, #colorbox p.course-notice {  width: auto; background-image: none; background-color: #C9DEED; border: 1px solid #74A8CF; border-radius: 5px; padding: 12px; margin: 12px 0 14px; color: #004488; font-weight: normal; font-style: normal; }
.schoolpage #course-content p.course-notice-light, #colorbox p.course-notice-light { background-image: none; background-color: #E7ECF0; border-color: #A9B5BE; color: #3E4144; }
.sidebar-module p.course-notice, .sidebar-module div.course-notice-cont { border-radius: 0; width: 99%; margin: 0 -6px 4px; padding: 8px; background-image: none; background-color: #C9DEED; border: 1px solid #74A8CF; color: #0C2947; font-weight: normal; font-style: normal; }
.sidebar-module div.course-notice-cont p { font-weight: normal; font-style: normal; }
.sidebar-module p.course-notice-light { background-image: none; background-color: #E7ECF0; border-color: #A9B5BE; color: #3E4144; }
#colorbox p.apply-notice,
.schoolpage #course-content p.apply-notice { background-image: none; background-color: #efefef; padding: 10px; float: left; border-radius: 4px; }

/* BBQ nav and content */
.bbq-content { float: left; clear: both; width: 100%; border-top: 1px solid #f0b604; margin-bottom: 26px; }
.bbq-nav a { display: block; float: left; width: 48.5%; margin-right: 1%; background: #004488; color: white; border-radius: 6px 6px 0 0; height: 32px; text-align: center; border-bottom: 2px solid #004488; padding-top: 0; line-height: 32px; }
.bbq-nav2 a { width: 24.4%; text-indent: 2px; margin-right: 0.4%; padding-top: 5px; line-height: 14px; }
.bbq-nav a.bbq-current { background: white; font-weight: bold; border: 1px solid #c0c0c0; /*border-bottom: 3px solid #F0B604; height: 30px;*/
border-bottom: 0px solid #F0B604;
height: 37px;
position: relative;
top: 1px;
margin-top: -4px; }
.main-content .bbq-nav a.inactive { background: #899AB4; cursor: default; color: #E2E8EF !important; border-bottom: 2px solid #899AB4; }
.main-content .bbq-nav a,
.main-content .bbq-nav a:visited,
.main-content .bbq-nav a:active,
.main-content .bbq-nav a:hover { color: white; text-decoration: none; }
.main-content .bbq-nav a:hover { text-decoration: underline; }
.main-content .bbq-nav a.bbq-current,
.main-content .bbq-nav a.bbq-current:visited,
.main-content .bbq-nav a.bbq-current:active,
.main-content .bbq-nav a.bbq-current:hover { cursor: default; color: #004488; text-decoration: none; }

/* Sidebar content */
.sidebar-module { clear: both; float: left; border: 1px solid #cdcdcd; padding: 10px 10px 0 10px; margin-bottom: 12px; width: 100%; font-size: 0.95em; }
#IELTS table, .cricos-codes table, .tac-codes table { margin-top: -1.2em; width: 90% }
.cricos-codes table, .location-tab table, .tac-codes table { width: 100%; }
.location-tab td:first-child { width: 73%; }
div.location-tab p { margin-top: -1.2em; }
#IELTS td, #adm-reqs-cntry td, .cricos-codes td, .location-tab td, .tac-codes td { padding: 0; }
.teaching-table { width:43%; float:left; margin:6px 0 12px 5%; }
.teaching-table-sep { border-left: 1px dashed #d7d7d7; float: left; height: 100px; margin: 12px 0 0 2%; }
#unit-avails { margin-bottom: 1em; }
#unit-avails td, .teaching-table td { border-bottom: 1px solid #e3e3e3; }
.teaching-table tr:first-child td { border-bottom: 1px solid #D7D7D7; }
.bx-wrapper { margin: 0 auto 12px; }
#related-courses ul, #related-links ul { margin-left: 0; }
#IELTS tr.data-label-Overall td { font-weight: bold; }
#adm-reqs-cntry { height: 156px; overflow-y: scroll; border: 1px solid #adadad; background: #efefef; margin-top: -1.2em; margin-bottom: 1em; }
#adm-reqs-cntry td { font-size: 0.9em; border-bottom: 1px dotted #cdcdcd; padding: 3px; }

/* Testimonials */
#testimonials-wrapper { margin-bottom: 50px; }
.schoolpage .main-content ul#testimonials { margin: 0; padding: 0; }
.schoolpage .main-content ul#testimonials li { margin: 0; padding: 0; }
.schoolpage .main-content ul#testimonials li a { display: block; color: #121212; text-decoration: none; }
.schoolpage .main-content ul#testimonials li .test-thumb { float: left; width: 70px; margin: 4px 12px 4px 0; }
.schoolpage .main-content ul#testimonials li .quote { font-size: 1.8em; padding-right: 3px; height: 10px; }
.schoolpage .main-content ul#testimonials li .open-quote { float: left; display: block; line-height: 26px; }
.schoolpage .main-content ul#testimonials li .close-quote { font-size: 1.6em; top: 3px; position: relative; line-height: 0em; }
.schoolpage .main-content ul#testimonials li .test-name { margin-bottom: 0; }
.schoolpage .main-content ul#testimonials li .test-degree { color: #555; font-size: 0.9em; margin-top: 5px; line-height: 1.3em; }

/* Structures */
#structure-loading { height: 33px; width: 220px; font-size: 0.9em; color: #004488; text-align: center; margin: 0 auto; }
.structure { width: 94%; margin-left: 3%; }
.group { width: 97.5%; margin-left: 16px; }
.structure td { padding: 5px 8px 2px; }
.study-plans .structure td { padding: 6px 8px; }
.structure td:first-child { padding-left: 34px; }
.structure td:last-child { width: 90px; }
.structure-placeholder .study-plans h3 { margin-top: 8px; font-size: 1.2em; }
.group-hdr td h3 { background: #F4F4F4; }
.group-hdr h4 { margin-left: 16px; }
h3.group-hdr, .group-hdr h3, .group-hdr h4, .group-hdr span { cursor: pointer; color: #0062c3; width: 100%; display: block; padding-bottom: 4px; }
.head1 td, .head2 td, .head3 td, h3.group-hdr { border-bottom: 1px solid #C9DEED; }
.study-plans .head2 td, .study-plans .head3 td { border-top: 1px solid #C9DEED; border-bottom: none; padding-left: 8px; }
.study-plans .head1 td { border-top: 1px solid #C9DEED; padding-left: 8px; }
.main-content td td { border-bottom: none; }
.structure h3, .structure h4 { line-height: 1.9em; margin: 0; padding: 0; font-weight: normal; font-family: Arial, sans-serif; }
.structure h4 { font-size: 1.2em; }
.structure h3 { font-size: 1.25em; margin-left: -34px; }
.study-plans h3 { margin-left: 2px; }
table.group { border-left: 1px solid #C9DEED; border-bottom: 1px solid #C9DEED; margin-bottom: 20px; border-spacing: 0px; }
.study-plans table.group { margin-left: 19px; }
.tooltip .structure { width: 600px; margin: 0; }
.instr td:first-child { font-style: italic; padding-left: 8px; }
.study-plans table .head1 td:first-child h3, .study-plans table .head2 td:first-child h4 { font-weight: bold; font-size: 1em; margin-top: 0; }
.head3 td:first-child { font-style: italic; font-weight: bold; }
.note-label { width: 44px; font-style: italic; color: #777; }
.tooltip{ display: none; position: absolute; z-index: 200000; background-color: #e4ecf5; color: black; margin-top: 0px; padding: 14px 12px 9px; border-radius: 0 10px 10px 0; border: 1px solid #91a0ac; }
.tooltip h3, .tooltip h4 { display: none; }
.tooltip .toolclose { right: 12px; position: absolute; font-size: 1.2em; top: 4px; }
.tooltip .toolclose:hover { text-decoration: none; }
#unit-groups { display: none; }

::-webkit-input-placeholder { /* WebKit browsers */ color: #555; }
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ color: #555; }
::-moz-placeholder { /* Mozilla Firefox 19+ */ color: #555; }
:-ms-input-placeholder { /* Internet Explorer 10+ */ color: #555; }
::-ms-clear { display: none; }

@media only screen and (min-width: 480px) {
  .bbq-nav2 a { padding-top: 0; line-height: 32px; font-size: 1em; text-indent: 0; }
  #top-buttons { margin: 0 24px 16px 0; }
  .button-link { width: 144px; margin: 0 3px 10px 6px; }
  .apply-text { float: left; width: 48%; }
}

@media only screen and (min-width: 570px) {
  .apply-text { float: left; width: 58%; }
}

@media only screen and (min-width: 768px) {
  html .schoolpage .main-content #site-nav-cont { width: 212px; margin-left: 10px; }
  #course-content { margin-right: 24px; width: 490px; margin-top: 0; }
  #discipline-img { display: block; width: 490px; }
  #about-course-hdr { display: none; }
  #upper-module,
  #testimonials-wrapper { display: block; }
  #lower-module { display: none; }
  h1.course-title #course-title-extra { white-space: nowrap; }
  #course-search-form #search-input { width: 180px; }
  h1 { font-size: 2.4em; }
  header #head-nav { background: transparent; }
  .schoolpage p.course-notice, .schoolpage div.course-notice-cont { width: 662px; padding: 6px 13px 6px 42px; margin-left: 10px; }
  .schoolpage div.course-notice-cont { width: 719px; }
  .sidebar-module p.course-notice, .sidebar-module div.course-notice-cont { width: 175px; padding: 6px 7px; margin: 0 0 8px; }
  .sidebar-module div.course-notice-cont { width: 190px; padding: 6px 7px; margin: 0 0 8px; }
  .apply-text { float: left; width: 50%; }
  .location-tab td:first-child { width: 59%; }
}

@media only screen and (min-width: 992px) {
  #course-content { margin-right: 26px; width: 690px; }
  #top-buttons { margin-right: 30px; }
  .schoolpage .main-content { width: 98%; margin: 24px 1% 36px; }
  html .cssT1SmPwrProgressAction_NextButton { width: 186px; text-align: right; padding-right: 44px; background-position: -70px -16px; }
  html .cssT1SmPwrProgressAction_NextButton:hover { background-position: -70px -93px; }
  #discipline-img { width: 690px; }
  #course-title-spacer { display: block; }
  .schoolpage p.course-notice, .schoolpage div.course-notice-cont { width: 852px; padding: 6px 22px 6px 42px; margin-left: 10px; }
  .schoolpage div.course-notice-cont { width: 918px; }
  .sidebar-module p.course-notice, .sidebar-module div.course-notice-cont { width: 180px; margin: 0 -2% 4px; padding: 8px; }
  .sidebar-module div.course-notice-cont { width: 198px; margin: 0 -2% 4px; padding: 8px 8px 0 8px; }
  .apply-text { float: left; width: 60%; }
}

@media only print {
  .bbq-nav, #top-buttons, #upper-module, #testimonials-wrapper { display: none; }
  html .schoolpage .main-content #site-nav-cont { display: block !important; }
  #unit-avails { width: 100%; }
}
</style>
<link rel="stylesheet" href="/courses/search.css"/>
<style>
@font-face {
  font-family: 'Bitter';
  font-style: normal;
  font-weight: 700;
  src: local('Bitter-Bold'), url(http://scu.edu.au/resources/font/bitter/bitter-bold-webfont.woff) format('woff');
}
#site-nav-cont { display: none; }
#course-content-tabs { display: none; }
</style>


<!-- Must be after styles but up early to prevent IE from stalling on mobile view -->
<!--[if (lt IE 9) & (!IEMobile)]>
<script src="/resources/js/libs/respond.min.js?v=2"></script>
<![endif]-->

<!-- JavaScript at bottom except for Modernizr -->
<script src="/resources/js/libs/modernizr-1.7.min.js"></script>

<!-- For iPhone 4 -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/SCU-template/img/h/apple-touch-icon.png">
<!-- For iPad 1-->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/SCU-template/img/m/apple-touch-icon.png">
<!-- For iPhone 3G, iPod Touch and Android -->
<link rel="apple-touch-icon-precomposed" href="/SCU-template/img/l/apple-touch-icon-precomposed.png">
<!-- For Nokia
<link rel="shortcut icon" href="img/l/apple-touch-icon.png"> CHROME IS USING THIS TOO -->
<!-- For everything else -->
<link rel="shortcut icon" href="/favicon.ico">

<!--iOS. Delete if not required
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="apple-touch-startup-image" href="img/splash.png">
 -->

<!--Microsoft. Delete if not required -->
<meta http-equiv="cleartype" content="on">



</head>

<body class="clearfix">
<a class="offleft" href="#maincontent">Skip to Content</a>
<div id="container" class="schoolpage">

<header role="banner" class="clearfix">
<nav id="global-nav" class="clearfix">
<ul>
<li><a href="http://scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C1-Home']);">Home</a></li>
<li><a href="http://scu.edu.au/futurestudents/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS']);">Future Students</a>
<ul>
<li><a href="http://scu.edu.au/courses/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-1']);">Course Options</a></li>
<li><a href="http://scu.edu.au/scuinfodays/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-1a']);">SCU Info Days  <sup class="minilabel" style="font-size: 8px;">NEW</sup></a></li>
<li><a href="http://scu.edu.au/distance/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-2']);">Distance and Online</a></li>
<li><a href="http://scu.edu.au/howtoapply/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-3']);">How to Apply</a></li>
<li><a href="http://scu.edu.au/fees/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-4']);">Fees</a></li>
<li><a href="http://scu.edu.au/campustours/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-5']);">Campus Tours</a></li>
<li><a href="http://scu.edu.au/futurestudents/index.php/20" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-6']);">Accommodation</a></li>
<li><a href="http://scu.edu.au/scholarships/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-7']);">Scholarships</a></li>
<li><a href="http://scu.edu.au/scupathways/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-8']);">Advanced Standing and<br> Pathways</a></li>
<li><a href="http://scucollege.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C2-FS-9']);">SCU College</a></li>

</ul></li><li><a href="http://scu.edu.au/international/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int']);">International</a>
<ul>
<li><a href="http://scu.edu.au/international/index.php/10/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-1']);">Study Options</a></li>
<li><a href="http://scu.edu.au/international/apply/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-2']);">How to Apply</a></li>
<li><a href="http://scu.edu.au/studyabroad/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-3']);">Study Abroad</a></li>
<li><a href="http://scu.edu.au/international/index.php/189" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-4']);">Student Support</a></li>
<li><a href="http://scu.edu.au/exchange/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-5']);">SCU Students <br/>Studying Overseas</a></li>
<li><a href="http://scu.edu.au/international/agents/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-6']);">Agents</a></li>
<li><a href="http://scu.edu.au/englishlanguage/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-7']);">English Language<br>Programs</a></li>
<li><a href="http://scu.edu.au/international/index.php/82/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C3-Int-8']);">International and <br>Enterprise</a></li>
</ul>
</li>
<li><a href="http://scu.edu.au/students/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS']);">Students</a>
<ul>
<li><a href="http://scu.edu.au/gettingstarted/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-1']);">New Students</a></li>
<li><a href="http://scu.edu.au/students/index.php/42/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-2']);">Enrolling</a></li>
<li><a href="http://scu.edu.au/students/index.php/4/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-3']);">Student <br>Administration</a></li>
<li><a href="http://scu.edu.au/students/index.php/47/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-4']);">Study Resources</a></li>
<li><a href="http://scu.edu.au/students/index.php/109/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-5']);">Services</a></li>
<li><a href="http://scu.edu.au/activities/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-6']);">Culture, Sport <br>and Recreation</a></li>
<li><a href="http://scu.edu.au/students/index.php/108/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-7']);">Opportunities</a></li>
<li><a href="http://scu.edu.au/students/index.php/10/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C4-CS-8']);">Graduation <br>and Beyond</a></li>
</ul>
</li><li><a href="http://scu.edu.au/research/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res']);">Research</a>
<ul>
<li><a href="http://scu.edu.au/research/index.php/42/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res-1']);">Higher Degrees<br>Research</a></li>
<li><a href="http://scu.edu.au/research/index.php/60/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res-2']);">Research Services<br>and Grants</a></li>
<li><a href="http://scu.edu.au/research/index.php/53/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res-3']);">How to Apply</a></li>
<li><a href="http://scu.edu.au/research/index.php/40/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res-4']);">Ethics</a></li>
<li><a href="http://scu.edu.au/research/index.php/66/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res-5']);">Research Centres/<br />CRN</a></li>
<li><a href="http://scu.edu.au/geoscience/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res-6']);">Southern Cross<br>GeoScience</a></li>
<li><a href="http://scu.edu.au/scps/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C5-Res-7']);">Southern Cross<br>Plant Science</a></li>
</ul>
</li>
<li><a href="http://www.scu.edu.au/space/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com']);">Community & News</a>
<ul>
<li><a href="http://scu.edu.au/sustainability/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-1']);">Sustainability</a></li>
<li><a href="http://www.scu.edu.au/space/index.php/4/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-2']);">Community Engagement</a></li>
<li><a href="http://scu.edu.au/news/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-3']);">SCU News</a></li>
<li><a href="http://scu.edu.au/scunews/index.php/31/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-4']);">SCU on Social Media</a></li>
<li><a href="http://discover.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-5']);">Discover eNews</a></li>
<li><a href="http://scu.edu.au/events/index.php/events/all/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-6']);">Events</a></li>
<li><a href="http://scu.edu.au/alumni/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-7']);">Alumni</a></li>
<li><a href="http://scu.edu.au/experts/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-8']);">Find an Expert</a></li>
<li><a href="http://www.scu.edu.au/risingstars/index.php/4/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C6-Com-9']);">Rising Stars Program</a></li>
</ul>
</li><li><a href="http://scu.edu.au/about/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab']);">About Us</a>
<ul>
<li><a href="http://scu.edu.au/schools/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab-1']);">Academic Schools</a></li>
<li><a href="http://20years.scu.edu.au" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab-1a']);">20th Anniversary</a></li>
<li><a href="http://scu.edu.au/about/index.php/4" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab-2a']);">Locations</a></li>
<li><a href="http://scu.edu.au/jobs/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab-5']);">Jobs @ SCU</a></li>
<li><a href="http://scu.edu.au/about/index.php/46/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab-6']);">SCU Executives</a></li>
<li><a href="http://scu.edu.au/staffdirectory/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab-7']);">Staff Directory</a></li>
<li><a href="http://scu.edu.au/contact/" onclick="_gaq.push(['_trackEvent', 'GH-Nav', 'Click', 'C7-Ab-8']);">Contact Us</a></li>
</ul>
</li>
</ul>
</nav>

<div id="banner">

<h1 id="SCU-logo" tabindex="1"><a href="http://scu.edu.au/" onclick="_gaq.push(['_trackEvent','GH-Logo','Click','SCU_Logo']);">Southern Cross <br /><span class="second">University</span><span class="printOnly" id="slogan">It's all about U</span><img id="logo-lo" src="http://www.scu.edu.au/SCU-template/img/logo/SCU-Logo-White.png" alt="Southern Cross University" /><img id="logo-hi" src="http://www.scu.edu.au/SCU-template/img/logo/_SCU_logo@2x.png" alt="" style="display: none;" /></a></h1>



<form id="search-form" action="http://search.scu.edu.au/" method="get" tabindex="7">
<input name="site" value="all_scu" type="hidden">
<input name="/?site" value="all_scu" type="hidden">
<input name="client" value="scu_xhtml" type="hidden">
<input name="output" value="xml_no_dtd" type="hidden">
<input name="proxystylesheet" value="scu_xhtml" type="hidden">
<input name="sort" value="date:D:L:d1" type="hidden">
<input name="entqr" value="3" type="hidden">
<input name="oe" value="UTF-8" type="hidden">
<input name="ie" value="UTF-8" type="hidden">
<input name="ud" value="1" type="hidden">
<input id="search-submit" name="btnG" title="Search site" alt="Search site" type="submit" value="Search site" />
<input id="search-input" name="q" type="text" aria-haspopup="true" autocomplete="off" maxlength="256" placeholder="Search site" title="Search site" />
</form>

<nav id="head-nav">
<ul>
<li tabindex="2"><a href="http://learn.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GH-Icons', 'Click', '01-MySCU']);">MySCU</a></li>
<li tabindex="3"><a href="http://email.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GH-Icons', 'Click', '02-Email']);">Email</a></li>
<li tabindex="4"><a href="http://scu.edu.au/library/"  onclick="_gaq.push(['_trackEvent', 'GH-Icons', 'Click', '03-Library']);">Library</a></li>
<li tabindex="5"><a href="http://scu.edu.au/services/"  onclick="_gaq.push(['_trackEvent', 'GH-Icons', 'Click', '04-AZ']);">A-Z</a></li>
<li tabindex="6"><a href="http://scu.edu.au/contact/"  onclick="_gaq.push(['_trackEvent', 'GH-Icons', 'Click', '05-Contact']);">Contact</a></li>
</ul>
</nav>
</div>
</header>

<section id="quicklinks">
<h4><a href="/" onclick="_gaq.push(['_trackEvent','GH-QL','Click','QL']);">Quick Links</a></h4>
<nav>
<ul>
<li style="font-size: 12px;font-weight: bold;text-transform: uppercase;">General</li>
<li><a href="http://scu.edu.au/services/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-01']);">A-Z of SCU</a></li>
<li><a href="http://scu.edu.au/academicboard/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-02']);">Academic Board</a></li>
<li><a href="http://scu.edu.au/schools/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-03']);">Academic Schools</a></li>
<li><a href="http://scu.edu.au/academicskills/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-04']);">Academic Skills</a></li>
<li><a href="http://scu.edu.au/equity/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-05']);">Equity and Diversity Office</a></li>
<li><a href="http://scu.edu.au/jobs/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-06']);">Jobs @ SCU</a></li>
<li><a href="http://scu.edu.au/news/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-07']);">Media Releases</a></li>
<li><a href="http://scu.edu.au/policy/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-08']);">SCU Policy Library</a></li>
<li><a href="http://scu.edu.au/staff/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-09']);">Staff Directory</a></li>
<li><a href="http://scu.edu.au/it/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-10']);">Technology Services</a></li>
<li><a href="http://staff.scu.edu.au/vc/index.php/dds/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C3-11']);">VC's Weekly Updates</a></li>
</ul><title>2</title>
<ul>
<li style="font-size: 12px;font-weight: bold;text-transform: uppercase;
">Current Students</li>

<li><a href="http://scu.edu.au/library/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-Library']);">Library</a></li>
<li><a href="http://scu.edu.au/myenrolment/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-MyEnrolment']);">My Enrolment</a></li>
<li><a href="http://scu.edu.au/students/index.php/107/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-Out-of-HoursCrisisSupportLine']);">Out-of-Hours Crisis Support Line</a></li>
<li><a href="http://scu.edu.au/pcfinder/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-PCFinder']);">PC Finder</a></li>
<li><a href="http://scu.edu.au/scheduleofunits" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-ScheduleofUnits']);">Schedule of Units</a></li>
<li><a href="http://scu.edu.au/handbook/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-StudentHandbook']);">Student Handbook</a></li>
<li><a href="http://scu.edu.au/students/index.php/82/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-StudentRepresentation']);">Student Representation</a></li>
<li><a href="http://scu.edu.au/teachingcalendar/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-TeachingCalendar']);">Teaching Calendar</a></li>
<li> </li>
<li style="font-size: 12px;font-weight: bold;text-transform: uppercase;">STAFF</li>
<li><a href="http://staff.scu.edu.au/change/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-Change@SCU']);">Change @ SCU</a></li>
<li><a href="http://scu.edu.au/hr/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C2-HRServices']);">HR Services</a></li>
</ul><title>3</title>
<ul>
<li style="font-size: 12px;font-weight: bold;text-transform: uppercase;">Future Students</li>
<li><a href="http://scu.edu.au/courses/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-01']);">Course Options</a></li>
<li><a href="http://scu.edu.au/accommodation/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-02']);">Accommodation Services</a></li>
<li><a href="http://scu.edu.au/campustours/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-03']);">Campus Tours</a></li>
<li><a href="http://scu.edu.au/distance/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-04']);">Distance and Online Study</a></li>
<li><a href="http://scu.edu.au/enquiries/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-05']);">Enquire Online</a></li>
<li><a href="http://scu.edu.au/international/index.php/10/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-06']);">International Course Options</a></li>
<li><a href="http://scu.edu.au/postgraduate/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-07']);">Postgraduate Course Options</a></li>
<li><a href="http://scu.edu.au/preparingforsuccess/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-08']);">Preparing for Success Program</a></li>
<li><a href="http://scu.edu.au/scholarships/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-09']);">Scholarships</a></li>
<li><a href="http://scucollege.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-10']);">SCU College</a></li>
<li><a href="http://scu.edu.au/scuinfodays/" onclick="_gaq.push(['_trackEvent', 'GH-QL', 'Click', 'QL-C1-InfoDays']);">SCU Info Days <sup class="minilabel" style="font-size:8px;">NEW</sup></a></li>
</ul>

</nav>
</section>

<div id="slider-cont">

</div>

<div id="body-container"><a name="maincontent" id="maincontent"></a>

<div id="nav-sidebar">
<div id="upper-nav">

                               <div id="site-nav-cont">
                                       <h2><a href="http://scu.edu.au/application-templates/">SCU Application Template</a></h2>
                                       <nav id="site-nav" class="site-nav">
                                       <ul>
                                      <li class="home-item flat">
                                              <a href="http://scu.edu.au/application-templates/" class="site-title" tabindex="8"><span class="home-text">Home </span><span class="org-text">SCU Application Template</span></a>
                                      </li>

                                      </ul>
                                      </nav>
                               </div>
</div>
<div class="marketing-btns clearfix">
</div>
</div><div class="content clearfix">

<p id="search-crumbs" class="breadcrumbs" style="display: none">
<a href="http://scu.edu.au/">Home</a>  &gt;  <a href="http://scu.edu.au/futurestudents">Future Students</a>  &gt;  <a href="/courses/">Find a course</a> &gt; <span>Search results</span>
</p>
<p id="landing-crumbs" class="breadcrumbs">
<a href="http://scu.edu.au/">Home</a>  &gt;  <a href="http://scu.edu.au/futurestudents">Future Students</a>  &gt;  <span>Find a course</span>
</p>



<div class="main-content" role="main">
<h1 class="course-title">Find a course</h1><div id="top-buttons"><a href="http://scu.edu.au/futurestudents/index.php/13" class="button-link question-outage" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'HeaderButton', 'AskAQuestion', 0, true]);">Ask a Question</a></div>

                       <noscript class="banner-msg"><p>It appears that you might have Javascript disabled in your browser. If you have arrived here via an email or web link it may not show the results you expect. Use the filter options and keyword to find what you are looking for.</p></noscript>
                       <noscript><style>.main-content #landing-content { display: block; }</style></noscript>
               <form id="GSA-search-form" method="get" action="" class="course-search-form">
                 <div id="GSA-results">

                 <div style="width: 200px;
float: left;
margin: 20px;"><p>Unfortunately our course search isn’t working at present so we’ve provided links to our individual school/college pages.
				   </p><p>
				 We’re sorry for any inconvenience caused and will restore the course search as soon as possible. Thanks for your patience.
  </p></div>

                   <div id="site-nav-cont">
                         <div class="bbq-nav search-filter-tabs">
                           <a class="bbq-current">Search options</a>
                         </div>
                         <div class="sidebar-module filtering-module">
                               <input type="hidden" name="search-type" id="search-type" value="course"/>
                           <div id="landing-filter">
        <div id="filtering-sidebar">
            <div id="filtering">

               <input type="text" name="q" value="" id="GSA-search-input" maxlength="256" alt="Search Query" title="Enter search query" />
               <input type="submit" value="Search courses" id="GSA-search-submit" />
               <span class="other-search"> or <a href="http://search.scu.edu.au/units" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'Click', 'SearchOptions-SearchUnit', 0, true]);">search units</a>.</span>
               <!--<select id="search-type" name="search-type">
                       <option value="course" selected>Courses</option>
                       <option value="unit">Units</option>
               </select>-->

               <script type="text/javascript">document.getElementById('GSA-search-input').focus();</script>

            <div class="filter-option INT-content DOM-content course-content " id="courses%2Edom-int-intakes-cont">
                <h3 class=""><span class="ui-icon"></span>Available to</h3>
                               <div class="filter-pnl">
                                              <span class="filter-choice">
                                                     <input class="filter default-opt" type="radio" id="dom-int-intakes-DOM" name="courses%2Edom-int-intakes" value="DOM" checked>
                                                     <label for="dom-int-intakes-DOM">Domestic students</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="radio" id="dom-int-intakes-INT" name="courses%2Edom-int-intakes" value="INT">
                                                     <label for="dom-int-intakes-INT">International students</label>
                                              </span>
                                              <span class="filter-pnl-note"><a href="http://scu.edu.au/about/index.php/52" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'SearchOptions', 'IntOffshoreStudents', 0, true]);">International offshore students</a></span>
                               </div>
            </div>
            <div class="filter-option INT-content DOM-content course-content unit-content " id="courses%2Eyear-cont">
                <h3 class=""><span class="ui-icon"></span>Years</h3>
                               <div class="filter-pnl">

                                              <span class="filter-pnl-note"><span id="prev-yr-link"><a href="http://scu.edu.au/docs/handbook/index.php/dds" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'SearchOptions', 'ViewPreviousYears', 0, true]);">view previous years</a></span></span>

                  <select class="filter" id="year" name="courses%2Eyear">
                    <option value="">All</option>
                    <option value="2014">2014</option>
                    <option value="2015" selected>2015</option>
                  </select>
                               </div>
            </div>
                               <div id="advanced-search-link" class="filter-option">
                                      <a href=""><span class="plus">+</span><span class="minus">-</span> Advanced options</a>
                               </div>
                               <div id="advanced-opts">
            <div class="filter-option INT-content DOM-content course-content " id="courses%2Eaward-level-type-cont">
                               <h3 class="ui-collapse"><span class="ui-icon"></span>Course level</h3>
                               <div class="filter-pnl">
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="award-level-type:N" name="courses%2Eaward-level-type:N" value="N">
                                                     <label for="award-level-type:N">Preparation</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="award-level-type:UG" name="courses%2Eaward-level-type:UG" value="UG">
                                                     <label for="award-level-type:UG">Undergraduate</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="award-level-type:HON" name="courses%2Eaward-level-type:HON" value="HON">
                                                     <label for="award-level-type:HON">Honours</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="award-level-type:PG" name="courses%2Eaward-level-type:PG" value="PG">
                                                     <label for="award-level-type:PG">Postgraduate coursework</label>
                                              </span>
                                              <span class="filter-pnl-note"><a href="http://scu.edu.au/graduateschool/index.php/12">Higher degrees by research</a></span>
                               </div>
            </div>
            <div class="filter-option INT-content DOM-content course-content unit-content " id="session-cont">
                               <h3 class="ui-collapse"><span class="ui-icon"></span>Session</h3>
                               <div class="filter-pnl">
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="session:11" name="session:11" value="11">
                                                     <label for="session:11">Session 1</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="session:12" name="session:12" value="12">
                                                     <label for="session:12">Session 2</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="session:13" name="session:13" value="13">
                                                     <label for="session:13">Session 3</label>
                                              </span>
                                              <span class="filter-pnl-note">See the <a href="http://www.scu.edu.au/futurestudents/index.php/7">teaching calendar</a> for information about intakes</span>
                               </div>
            </div>
            <div class="filter-option INT-content DOM-content course-content unit-content " id="location-cont">
                               <h3 class="ui-collapse"><span class="ui-icon"></span>Location</h3>
                               <div class="filter-pnl">
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:GCB" name="location:GCB" value="GCB">
                                                     <label for="location:GCB">Gold Coast</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:L" name="location:L" value="L">
                                                     <label for="location:L">Lismore</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:CH" name="location:CH" value="CH">
                                                     <label for="location:CH">Coffs Harbour</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:U" name="location:U" value="U">
                                                     <label for="location:U">Distance education</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:MSC" name="location:MSC" value="MSC">
                                                     <label for="location:MSC">National Marine Science Centre</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:SYD" name="location:SYD" value="SYD">
                                                     <label for="location:SYD">Sydney</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:S" name="location:S" value="S">
                                                     <label for="location:S">The Hotel School Sydney</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:MLB" name="location:MLB" value="MLB">
                                                     <label for="location:MLB">Melbourne</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="location:MEL" name="location:MEL" value="MEL">
                                                     <label for="location:MEL">The Hotel School Melbourne</label>
                                              </span>
                               </div>
            </div>
            <div class="filter-option INT-content DOM-content course-content " id="courses%2Esecondary-discipline-cont">
                               <h3 class="ui-collapse"><span class="ui-icon"></span>Study area</h3>
                               <div class="filter-pnl">
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:business" name="courses%2Esecondary-discipline:business" value="business">
                                                     <label for="secondary-discipline:business">Business</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:creative" name="courses%2Esecondary-discipline:creative" value="creative">
                                                     <label for="secondary-discipline:creative">Creative and Performing Arts</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:education" name="courses%2Esecondary-discipline:education" value="education">
                                                     <label for="secondary-discipline:education">Education</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:environment" name="courses%2Esecondary-discipline:environment" value="environment">
                                                     <label for="secondary-discipline:environment">Environment, Science and Engineering</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:health" name="courses%2Esecondary-discipline:health" value="health">
                                                      <label for="secondary-discipline:health">Health and Human Sciences</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:arts" name="courses%2Esecondary-discipline:arts" value="arts">
                                                     <label for="secondary-discipline:arts">Humanities and Social Sciences</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:indigenous" name="courses%2Esecondary-discipline:indigenous" value="indigenous">
                                                     <label for="secondary-discipline:indigenous">Indigenous Studies</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:information" name="courses%2Esecondary-discipline:information" value="information">
                                                     <label for="secondary-discipline:information">Information Technology</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:law" name="courses%2Esecondary-discipline:law" value="law">
                                                     <label for="secondary-discipline:law">Law and Justice</label>
                                              </span>
                                              <span class="filter-choice">
                                                     <input class="filter" type="checkbox" id="secondary-discipline:tourism" name="courses%2Esecondary-discipline:tourism" value="tourism">
                                                     <label for="secondary-discipline:tourism">Tourism and Hospitality</label>
                                              </span>
                               </div>
            </div>
          <input type="submit" id="filter-btn" name="filter" value="Search courses" />
          <input type="reset" id="clear-btn" name="clear" value="Clear filters" style="display: none;" />
                 </div>
          </div>
        </div></div>
                         </div>
                         <div id="related-links" class="sidebar-module upper-nav">

                           <h3>Related links</h3>
                                              <ul>
                                 <li><a href="http://scu.edu.au/schools/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'AcademicSchools', 0, true]);">Academic schools</a></li>
                                 <li><a href="http://scu.edu.au/campuses/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'CampusLocations', 0, true]);">Campus locations</a></li>
                                 <li><a href="http://scu.edu.au/distance/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'DistanceEdOnline', 0, true]);">Distance education (online) study</a></li>
                                 <li><a href="http://scu.edu.au/graduateschool/index.php/12" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'HighDegResearch', 0, true]);">Higher degrees by research</a></li>
                                 <li><a href="http://scu.edu.au/futurestudents/index.php/7" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'KeyDates', 0, true]);">Key dates</a></li>
                                 <li><a href="http://scu.edu.au/scupathways/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'Pathways', 0, true]);">Pathways</a></li>
                                 <li><a href="http://scu.edu.au/scuinfoday/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'SCUInfoDays', 0, true]);">SCU Info Days</a></li>
                                 <li><a href="http://scu.edu.au/universitywide/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'UniWideMajors', 0, true]);">Uni-wide majors</a></li>
                       </ul>

                         </div>
                   </div><div id="landing-content">
                       <div id="course-content" class="bbq course-content">
                         <input type="hidden" name="num" id="fake-num" value="10"/>
                         <div id="course-content-tabs" class="bbq-nav bbq-nav2 search-landing-tabs">
                           <a href="#undergrad" class="bbq-link bbq-current" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'TabClick', 'Undergraduate', 0, true]);">Undergraduate</a>
                           <a href="#postgrad" class="bbq-link" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'TabClick', 'Postgraduate', 0, true]);">Postgraduate</a>
                           <a href="#honours" class="bbq-link" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'TabClick', 'Honours', 0, true]);">Honours</a>
                           <a href="#preparation" class="bbq-link" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'TabClick', 'Preparation', 0, true]);">Preparation</a>
                         </div>
                         <div class="bbq-content">
			    <div id="undergrad" class="bbq-item bbq-default tab-cont">
		          <h2>Browse undergraduate courses by subject</h2>
<p>
<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Abusiness=true" class="fsco-btn btn-bus" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-Business', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_business.png" class="" border="0" title="Business" alt="Business"><span class="subjecttext">Business 
<br>&nbsp;</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Acreative=true" class="fsco-btn btn-art" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-CreativePerfArts', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_arts.png" class="" border="0" title="Creative &amp; Performing Arts" alt="Creative &amp; Performing Arts"><span class="subjecttext">Creative &amp;<br>Performing Arts</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aeducation=true" class="fsco-btn btn-edu" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-Education', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_education.png" class="" border="0" title="Education" alt="Education"><span class="subjecttext">Education<br>&nbsp;</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aenvironment=true" class="fsco-btn btn-ese" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-EnvirSciEng', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_ese.png" class="" border="0" title="Engineering, Science and Environment" alt="Environment, Science and Environment"><span class="subjecttext">Environment,<br>Science &amp;<br>Engineering</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Ahealth=true" class="fsco-btn btn-hhs" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-HealthHumanSci', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_health.png" class="" border="0" title="Health and Human Sciences" alt="Health and Human Sciences"><span class="subjecttext">Health &amp;<br>Human<br>Sciences</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aarts=true" class="fsco-btn btn-art btn-hum" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-HumanitiesSocSci', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_humanities.png" class="" border="0" title="Humanities and Social Sciences" alt="Humanities and Social Sciences"><span class="subjecttext">Humanities &amp;<br>Social Sciences</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aindigenous=true" class="fsco-btn btn-ind" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-IndigenousStudies', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_indigenous.png" class="" border="0" title="Indigenous Studies" alt="Indigenous Studies"><span class="subjecttext">Indigenous <br>Studies</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Ainformation=true" class="fsco-btn btn-it" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-IT', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_it.png" class="" border="0" title="Information Technology" alt="Information Technology"><span class="subjecttext">Information<br>Technology</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Alaw=true" class="fsco-btn btn-law" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-LawJustice', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_law.png" class="" border="0" title="Law and Justice" alt="Law and Justice"><span class="subjecttext">Law &amp;<br>Justice</span></span> </a>

<a href="#award-level-type%3AUG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Atourism=true" class="fsco-btn btn-th" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'UG-TourismHospitality', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_tourism.png" class="" border="0" title="Tourism and Hospitality Management" alt="Tourism and Hospitality Management"><span class="subjecttext">Tourism &amp;<br>Hospitality</span></span> </a>
</p>
		

				</div>
			    <div id="postgrad" class="bbq-item tab-cont visuallyhidden">
		          <h2>Browse postgraduate courses by subject</h2>
		<p>Information about higher degrees by research is available from the <a href="http://scu.edu.au/research/">Division of Research</a></p>
<p>
<a href="#award-level-type%3APG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Abusiness=true" class="fsco-btn btn-bus" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'PG-Business', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_business.png" class="" border="0" title="Business" alt="Business"><span class="subjecttext">Business
<br>&nbsp;</span></span> </a>

<a href="#award-level-type%3APG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aeducation=true" class="fsco-btn btn-edu" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'PG-Education', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_education.png" class="" border="0" title="Education" alt="Education"><span class="subjecttext">Education<br>&nbsp;</span></span> </a>

<a href="#award-level-type%3APG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aenvironment=true" class="fsco-btn btn-ese" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'PG-EnvirSciEng', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_ese.png" class="" border="0" title="Engineering, Science and Environment" alt="Environment, Science and Environment"><span class="subjecttext">Environment,<br>Science &amp;<br>Engineering</span></span> </a>

<a href="#award-level-type%3APG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Ahealth=true" class="fsco-btn btn-hhs" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'PG-HealthHumanSci', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_health.png" class="" border="0" title="Health and Human Sciences" alt="Health and Human Sciences"><span class="subjecttext">Health &amp;<br>Human<br>Sciences</span></span> </a>

<a href="#award-level-type%3APG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aarts=true" class="fsco-btn btn-art btn-hum" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'PG-HumanitiesSocSci', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_humanities.png" class="" border="0" title="Humanities and Social Sciences" alt="Humanities and Social Sciences"><span class="subjecttext">Humanities &amp;<br>Social Sciences</span></span> </a>

<a href="#award-level-type%3APG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aindigenous=true" class="fsco-btn btn-ind" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'PG-IndigenousStudies', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_indigenous.png" class="" border="0" title="Indigenous Studies" alt="Indigenous Studies"><span class="subjecttext">Indigenous <br>Studies</span></span> </a>

<a href="#award-level-type%3APG=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Atourism=true" class="fsco-btn btn-th" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'PG-TourismHospitality', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_tourism.png" class="" border="0" title="Tourism and Hospitality Management" alt="Tourism and Hospitality Management"><span class="subjecttext">Tourism &amp;<br>Hospitality</span></span> </a>
</p>

				</div>
			    <div id="honours" class="bbq-item tab-cont visuallyhidden">
		          <h2>Browse honours courses by subject</h2>
<p>
<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Abusiness=true" class="fsco-btn btn-bus" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-Business', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_business.png" class="" border="0" title="Business" alt="Business"><span class="subjecttext">Business
<br>&nbsp;</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Acreative=true" class="fsco-btn btn-art" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-CreativePerfArts', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_arts.png" class="" border="0" title="Creative &amp; Performing Arts" alt="Creative &amp; Performing Arts"><span class="subjecttext">Creative &amp;<br>Performing Arts</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aeducation=true" class="fsco-btn btn-edu" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-Education', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_education.png" class="" border="0" title="Education" alt="Education"><span class="subjecttext">Education<br>&nbsp;</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aenvironment=true" class="fsco-btn btn-ese" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-EnvirSciEng', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_ese.png" class="" border="0" title="Engineering, Science and Environment" alt="Environment, Science and Environment"><span class="subjecttext">Environment,<br>Science &amp;<br>Engineering</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Ahealth=true" class="fsco-btn btn-hhs" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-HealthHumanSci', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_health.png" class="" border="0" title="Health and Human Sciences" alt="Health and Human Sciences"><span class="subjecttext">Health &amp;<br>Human<br>Sciences</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aarts=true" class="fsco-btn btn-art btn-hum" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-HumanitiesSocSci', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_humanities.png" class="" border="0" title="Humanities and Social Sciences" alt="Humanities and Social Sciences"><span class="subjecttext">Humanities &amp;<br>Social Sciences</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Aindigenous=true" class="fsco-btn btn-ind" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-IndigenousStudies', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_indigenous.png" class="" border="0" title="Indigenous Studies" alt="Indigenous Studies"><span class="subjecttext">Indigenous <br>Studies</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Ainformation=true" class="fsco-btn btn-it" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-IT', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_it.png" class="" border="0" title="Information Technology" alt="Information Technology"><span class="subjecttext">Information<br>Technology</span></span> </a>

<a href="#award-level-type%3AHON=true&amp;courses%252Eaward-level-type-cont=true&amp;courses%252Esecondary-discipline-cont=true&amp;keyword=&amp;secondary-discipline%3Atourism=true" class="fsco-btn btn-th" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'ButtonClick', 'Ho-TourismHospitality', 0, true]);"><span><img src="http://scu.edu.au/assets/res/i/futurestudents/mktbtn_tourism.png" class="" border="0" title="Tourism and Hospitality Management" alt="Tourism and Hospitality Management"><span class="subjecttext">Tourism &amp;<br>Hospitality</span></span> </a>
</p>


				</div>
			    <div id="preparation" class="bbq-item tab-cont visuallyhidden">
		          <p style="margin-top: 22px;">SCU is renowned for its highly supportive environment and has years of experience in supporting students to become confident, independent learners. We hope to bring the opportunity of university study to as many people as possible through our courses:</p>
<ul>
  <li><a href="http://courses.scu.edu.au/courses/preparing-for-success-at-scu-program" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'Click', 'Prep-PreForSuc', 0, true]);">Preparing for Success at SCU Program</a>, offered on campus or by distance education, is an intensive 12-week program to equip students with academic skills appropriate for University.</li>
</ul>
<h3>International students</h3>
<p>Through its <a href="http://scucollege.scu.edu.au">English Language Programs</a> SCU College helps prepare students for undergraduate and postgraduate courses at Southern Cross University. English Language Programs focus on developing students skills in speaking, listening, reading and writing, as well as developing academic skills essential for success at university.</p>
<p>SCU College offers academic pathways for international students, through the <a href="http://courses.scu.edu.au/courses/diploma-of-business#intdom=international">Diploma of Business</a> and the <a href="http://courses.scu.edu.au/courses/associate-degree-of-business#intdom=international">Associate Degree of Business</a>.</p>

				</div>
			  </div>
                       </div></div><div id="search-content" style="display: none;">
                       <div id="course-content" class="course-content">
                         <div id="course-content-tabs" class="bbq-nav search-results-tabs">
                           <a class="bbq-current">Search results</a>
                         </div>
                         <div class="bbq-content">
                           <div id="results" class="bbq-item bbq-default">
                         <div id="results-cont"></div>
                               </div>
                         </div>
                       </div></div>
                         <div id="lower-related-links" class="sidebar-module lower-nav">

                           <h3>Related links</h3>
                                              <ul>
                                 <li><a href="http://scu.edu.au/schools/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'AcademicSchools', 0, true]);">Academic schools</a></li>
                                 <li><a href="http://scu.edu.au/campuses/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'CampusLocations', 0, true]);">Campus locations</a></li>
                                 <li><a href="http://scu.edu.au/distance/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'DistanceEdOnline', 0, true]);">Distance education (online) study</a></li>
                                 <li><a href="http://scu.edu.au/graduateschool/index.php/12" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'HighDegResearch', 0, true]);">Higher degrees by research</a></li>
                                 <li><a href="http://scu.edu.au/futurestudents/index.php/7" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'KeyDates', 0, true]);">Key dates</a></li>
                                 <li><a href="http://scu.edu.au/scupathways/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'Pathways', 0, true]);">Pathways</a></li>
                                 <li><a href="http://scu.edu.au/scuinfoday/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'SCUInfoDays', 0, true]);">SCU Info Days</a></li>
                                 <li><a href="http://scu.edu.au/universitywide/" onclick="_gaq.push(['_trackEvent', 'CourseSearch', 'RelatedLinks', 'UniWideMajors', 0, true]);">Uni-wide majors</a></li>
                       </ul>

                         </div>
                 </div>
               </form>
               <form action="" method="post">
                       <input type="hidden" name="last-search" id="last-search" value=""/>
               </form>
</div>

</div><div id="content-after"></div>

<div id="lower-nav">

                               <div id="site-nav-cont">
                                       <h2><a href="http://scu.edu.au/application-templates/">SCU Application Template</a></h2>
                                       <nav id="site-nav" class="site-nav">
                                       <ul>
                                      <li class="home-item flat">
                                              <a href="http://scu.edu.au/application-templates/" class="site-title" tabindex="8"><span class="home-text">Home </span><span class="org-text">SCU Application Template</span></a>
                                      </li>

                                      </ul>
                                      </nav>
                               </div>
</div>

<footer role="contentinfo" class="clearfix">
<div class="footer-nav">
<nav>
<h4>Most popular</h4>
<ul>
<li><a href="http://search.scu.edu.au/courses/#year=2015" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'MP-2015CourseOptions']);">2015 course options</a></li>
<li><a href="http://scu.edu.au/international/courses" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'MP-2015InternationalCourseOptions']);">2015 international course options</a></li>
<li><a href="http://scu.edu.au/futurestudents/index.php/20" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'MP-Accommodation']);">Accommodation</a></li>
<li><a href="http://scu.edu.au/distance/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'MP-DistanceOnlineStudy']);">Distance and online study</a></li>
<li><a href="http://scu.edu.au/it/messaging/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'MP-EmailCalendaring']);">Email and calendaring</a></li>
<li><a href="http://scu.edu.au/jobs/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'MP-Jobs']);">Jobs @ SCU</a></li>
</ul>
<h4>Important</h4>
<ul>
<li><a href="http://scu.edu.au/scuinfodays/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Imp-InfoDays']);">SCU Info Days   <sup class="minilabel" style="font-size: 8px;">NEW</sup></a></li>
<li><a href="http://scu.edu.au/futurestudents/index.php/7" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Imp-Dates']);">Key dates</a></li>
<li><a href="http://scu.edu.au/myenrolment/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Imp-MyEnrolment']);">My Enrolment</a></li>
<li><a href="http://scu.edu.au/orientation/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Imp-Orientation']);">Orientation</a></li>
<li><a href="http://scu.edu.au/scholarships/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Imp-Scholarships']);">Scholarships</a></li>
<li><a href="http://scu.edu.au/news/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'MP-SCUNews']);">SCU News</a></li>
</ul><br>
<a id="RUN-link" href="http://www.run.edu.au/" target="_blank" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'RUNimg']);"><img title="Regional Universities Network" src="/assets/res/i/scu/RUN_Logo.jpg" alt="The Regional Universities Network (RUN) is a network of six universities with headquarters in regional Australia and a shared commitment to playing a transformative role in their regions."></a>
</nav> <nav>
<h4>Courses</h4>
<ul>
<li><a href="http://scu.edu.au/business-school/index.php/33/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-BusIT']);">Business</a></li>
<li><a href="http://scu.edu.au/arts-social-sciences/index.php/2#course_cat_7090" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-CrePerArt']);">Creative and Performing Arts</a></li>
<li><a href="http://scu.edu.au/education/index.php/4/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-Edu']);">Education</a></li>
<li><a href="http://scu.edu.au/environment-science-engineering/index.php/22/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-ESE']);">Environment, Science and Engineering</a></li>
<li><a href="http://scu.edu.au/health-sciences/index.php/34/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-HHS']);">Health and Human Sciences</a></li>
<li><a href="http://scu.edu.au/arts-social-sciences/index.php/2/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-HSS']);">Humanities and Social Sciences</a></li>
<li><a href="http://scu.edu.au/gnibi-indigenous-studies/index.php/2/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-Ind']);">Indigenous Studies</a></li>
<li><a href="http://scu.edu.au/business-school/index.php/33#course_cat_7116" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-IT']);">Information Technology</a></li>
<li><a href="http://scu.edu.au/law-justice/index.php/5/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-Law']);">Law and Justice</a></li>
<li><a href="http://scucollege.scu.edu.au/index.php/3/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-SCUC']);">SCU College and Preparatory</a></li>
<li><a href="http://scu.edu.au/tourism-hospitality-management/index.php/42/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Courses-THM']);">Tourism and Hospitality</a></li>
</ul>
<h4>Course information</h4>
<ul>
<li><a href="http://scu.edu.au/futurestudents/index.php/dds#cat1634/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CI-2015StudyGuide']);">2015 study guide</a></li>
<li><a href="http://scu.edu.au/futurestudents/index.php/dds#cat1637/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CI-CourseBrochures']);">Course brochures</a></li>
<li><a href="http://scu.edu.au/courseguide/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CI-CouEnrGui']);">Course enrolment guides</a></li>
<li><a href="http://scu.edu.au/scuinfodays" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CI-InfoDays']);">SCU Info Days</a></li>
</ul>

</nav> <nav>
<h4>Information for</h4>
<ul>
<li><a href="http://scu.edu.au/alumni/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Info-Alumni']);">Alumni</a></li>
<li><a href="http://scu.edu.au/distance" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Info-DE']);">Distance and online study</a></li>
<li><a href="http://scu.edu.au/futurestudents" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Info-FS']);">Future students</a></li>
<li><a href="http://scu.edu.au/international" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Info-IS']);">International students</a></li>
<li><a href="http://scu.edu.au/postgraduate" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Info-PostgRes']);">Postgraduate and research</a></li>
<li><a href="http://scu.edu.au/students/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Info-Students']);">SCU students</a></li>
<li><a href="http://scu.edu.au/risingstars/index.php/3" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Info-ScholSupp']);">Scholarship supporters</a></li>
</ul>

<h4>Connect with SCU</h4>
<ul>
<li><a href="http://scu.edu.au/scunews/index.php/31#facebook" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Connect-Facebook']);"><img src="http://www.scu.edu.au/SCU-template/img/share-sml/facebook-share-sml.png" height="17" width="17" alt="Southern Cross University on Facebook" title="Southern Cross University on Facebook"> Facebook</a></li>
<li><a href="http://scu.edu.au/scunews/index.php/31#twitter" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Connect-Twitter']);"><img src="http://www.scu.edu.au/SCU-template/img/share-sml/twitter-share-sml.png" height="17" width="17" alt="Southern Cross University on Twitter" title="Southern Cross University on Twitter"> Twitter</a></li>
<li><a href="http://scu.edu.au/scunews/index.php/31#linkedin" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Connect-LinkedIn']);"><img src="http://www.scu.edu.au/SCU-template/img/share-sml/linkedin-share-sml.png" height="17" width="17" alt="Southern Cross University on LinkedIn" title="Southern Cross University on LinkedIn"> LinkedIn</a></li>
<li><a href="http://scu.edu.au/scunews/index.php/31#youtube" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Connect-YouTube']);"><img src="http://www.scu.edu.au/SCU-template/img/share-sml/youtube-share-sml.png" height="17" width="17" alt="Southern Cross University on YouTube" title="Southern Cross University on YouTube"> YouTube</a></li>
<li><a href="http://scu.edu.au/itunesu/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Connect-iTunesU']);"><img src="http://www.scu.edu.au/SCU-template/img/share-sml/itunesu-share-sml.png" height="17" width="17" alt="Southern Cross University on iTunes" title="Southern Cross University on iTunes"> iTunesU</a></li>
<li><a href="http://scu.edu.au/enquiries" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'Connect-OnlineEnquiry']);">Online enquiry</a></li>
</ul>


</nav> <nav class="last">
<h4>Commercial services</h4>
<ul>
<li><a href="http://scu.edu.au/eal/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CommServ-EAL']);">Environmental Analysis Laboratory</a></li>
<li><a href="http://invercauldhouse.com.au/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CommServ-InvHouse']);">Invercauld House</a></li>
<li><a href="http://catering.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CommServ-SCUCater']);">SCU Catering</a></li>
<li><a href="http://gymandpool.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CommServ-SCUGymPool']);">SCU Fitness for You</a></li>
<li><a href="http://scu.edu.au/healthclinic/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CommServ-SCUHC']);">SCU Health Clinic</a></li>
<li><a href="http://unibarandcafe.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'CommServ-SCUUniBarCafe']);">SCU Unibar and Cafe</a></li>
</ul>

<h4>Information about</h4>
<ul>
<li><a href="http://scu.edu.au/space/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'InfA-CommEng']);">Community Engagement</a></li>
<li><a href="http://scu.edu.au/governance" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'InfA-Gover']);">Governance</a></li>
<li><a href="http://scu.edu.au/docs/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'InfA-PubPol']);">Publications and Policies</a></li>
<li style="padding-bottom: 10px;"><a href="http://scu.edu.au/sustainability/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', 'InfA-Sust']);">Sustainability</a></li>
</ul>


<a id="20year-link" href="http://20years.scu.edu.au/" onclick="_gaq.push(['_trackEvent', 'GF-Nav', 'Click', '20yearimg']);"><img style="margin-left: 5px; margin-top: -22px;" title="Southern Cross University 20 years" src="http://scu.edu.au/assets/res/i/scu/20years.gif" alt="Celebrating 20 years. Established 1994"></a>
</nav>
</div>
<div class="footer-shadow"></div>
<p class="top-link"><a href="#" onclick="_gaq.push(['_trackEvent', 'GF-Links', 'Click', 'GF-Links-Top']);">top</a></p>
<p class="global-footer">
<span class="SCU-copy-title">© <a href="http://scu.edu.au/" title="Southern Cross University" onclick="_gaq.push(['_trackEvent', 'GF-Links', 'Click', 'GF-Links-SCU']);">Southern Cross University</a><br /></span><span class="sep titlesep"> | </span><a href="http://scu.edu.au/wwwadmin/disclaimer/" onclick="_gaq.push(['_trackEvent', 'GF-Links', 'Click', 'GF-Links-Legals']);">Legals</a><span class="sep"> | </span><a href="http://scu.edu.au/privacy/" onclick="_gaq.push(['_trackEvent', 'GF-Links', 'Click', 'GF-Links-Privacy']);">Privacy</a><span class="sep"> | </span><a href="http://scu.edu.au/contact/" onclick="_gaq.push(['_trackEvent', 'GF-Links', 'Click', 'GF-Links-ContactUs']);">Contact Us</a><span class="admin-link"><span class="sep"> | </span><a href="http://study.scu.edu.au/websys/content/index.php?site_id=355&amp;action=Edit%20Item&amp;page_id=7" onclick="_gaq.push(['_trackEvent', 'GF-Links', 'Click', 'GF-Links-SiteAdmin']);">Site Admin</a></span><span class="sep abnsep"> | </span><span class="SCU-abn"><br />ABN: 41 995 651 524</span><span class="sep cricosep"> | </span><span class="SCU-cricos"><br />CRICOS Provider: 01241G</span>
</p>
</footer>

</div><!-- END BODY-CONTAINER -->
</div><!-- END CONTAINER -->

<!-- mathiasbynens.be/notes/async-analytics-snippet Change UA-XXXXX-X to be your site's ID
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script> -->
<script src="/resources/js/jquery/jquery-1.5.1.min.js" type="text/javascript"></script>
<!-- NOT NEEDED, getting local anyway
<script>window.jQuery || document.write('<script src="http://www.scu.edu.au/resources/js/libs/jquery-1.5.1.min.js">x3C/script>')</script>-->
<script src="/resources/js/jquery/jquery-ui-1.8.11.custom.min.js"></script>
<!-- Scripts -->
<script src="/SCU-template/js/plugins.js"></script>
<script src="/SCU-template/js/script.js"></script>

<script src="/resources/js/nivo/jquery.nivo.slider.pack.js"></script>

<!--[if (lt IE 9) & (!IEMobile)]>
<script src="/resources/js/libs/DOMAssistantCompressed-2.8.js"></script>
<script src="/resources/js/libs/selectivizr-1.0.1.js"></script>
<![endif]-->

<script src="/SCU-template/js/SCUlibs/SCU-template.js?v=1"></script>

<script src="/resources/visual-lightbox/engine/js/visuallightbox.js" type="text/javascript"></script>
<script src="/resources/visual-lightbox/engine/js/vlbdata.js" type="text/javascript"></script>
<script src="/resources/js/toggle.js" type="text/javascript"></script>

<!--<script src="http://courses.scu.edu.au/__data/assets/js_file/0019/568/jquery.ba-bbq.min.js?v=0.1.1"></script>-->
<script>
/*
 * jQuery BBQ: Back Button & Query Library - v1.3pre - 8/26/2010
 * http://benalman.com/projects/jquery-bbq-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,r){var h,n=Array.prototype.slice,t=decodeURIComponent,a=$.param,j,c,m,y,b=$.bbq=$.bbq||{},s,x,k,e=$.event.special,d="hashchange",B="querystring",F="fragment",z="elemUrlAttr",l="href",w="src",p=/^.*\?|#.*$/g,u,H,g,i,C,E={};function G(I){return typeof I==="string"}function D(J){var I=n.call(arguments,1);return function(){return J.apply(this,I.concat(n.call(arguments)))}}function o(I){return I.replace(H,"$2")}function q(I){return I.replace(/(?:^[^?#]*\?([^#]*).*$)?.*/,"$1")}function f(K,P,I,L,J){var R,O,N,Q,M;if(L!==h){N=I.match(K?H:/^([^#?]*)\??([^#]*)(#?.*)/);M=N[3]||"";if(J===2&&G(L)){O=L.replace(K?u:p,"")}else{Q=m(N[2]);L=G(L)?m[K?F:B](L):L;O=J===2?L:J===1?$.extend({},L,Q):$.extend({},Q,L);O=j(O);if(K){O=O.replace(g,t)}}R=N[1]+(K?C:O||!N[1]?"?":"")+O+M}else{R=P(I!==h?I:location.href)}return R}a[B]=D(f,0,q);a[F]=c=D(f,1,o);a.sorted=j=function(J,K){var I=[],L={};$.each(a(J,K).split("&"),function(P,M){var O=M.replace(/(?:%5B|=).*$/,""),N=L[O];if(!N){N=L[O]=[];I.push(O)}N.push(M)});return $.map(I.sort(),function(M){return L[M]}).join("&")};c.noEscape=function(J){J=J||"";var I=$.map(J.split(""),encodeURIComponent);g=new RegExp(I.join("|"),"g")};c.noEscape(",/");c.ajaxCrawlable=function(I){if(I!==h){if(I){u=/^.*(?:#!|#)/;H=/^([^#]*)(?:#!|#)?(.*)$/;C="#!"}else{u=/^.*#/;H=/^([^#]*)#?(.*)$/;C="#"}i=!!I}return i};c.ajaxCrawlable(0);$.deparam=m=function(L,I){var K={},J={"true":!0,"false":!1,"null":null};$.each(L.replace(/\+/g," ").split("&"),function(O,T){var N=T.split("="),S=t(N[0]),M,R=K,P=0,U=S.split("]["),Q=U.length-1;if(/\[/.test(U[0])&&/\]$/.test(U[Q])){U[Q]=U[Q].replace(/\]$/,"");U=U.shift().split("[").concat(U);Q=U.length-1}else{Q=0}if(N.length===2){M=t(N[1]);if(I){M=M&&!isNaN(M)?+M:M==="undefined"?h:J[M]!==h?J[M]:M}if(Q){for(;P<=Q;P++){S=U[P]===""?R.length:U[P];R=R[S]=P<Q?R[S]||(U[P+1]&&isNaN(U[P+1])?{}:[]):M}}else{if($.isArray(K[S])){K[S].push(M)}else{if(K[S]!==h){K[S]=[K[S],M]}else{K[S]=M}}}}else{if(S){K[S]=I?h:""}}});return K};function A(K,I,J){if(I===h||typeof I==="boolean"){J=I;I=a[K?F:B]()}else{I=G(I)?I.replace(K?u:p,""):I}return m(I,J)}m[B]=D(A,0);m[F]=y=D(A,1);$[z]||($[z]=function(I){return $.extend(E,I)})({a:l,base:l,iframe:w,img:w,input:w,form:"action",link:l,script:w});k=$[z];function v(L,J,K,I){if(!G(K)&&typeof K!=="object"){I=K;K=J;J=h}return this.each(function(){var O=$(this),M=J||k()[(this.nodeName||"").toLowerCase()]||"",N=M&&O.attr(M)||"";O.attr(M,a[L](N,K,I))})}$.fn[B]=D(v,B);$.fn[F]=D(v,F);b.pushState=s=function(L,I){if(G(L)&&/^#/.test(L)&&I===h){I=2}var K=L!==h,J=c(location.href,K?L:{},K?I:2);location.href=J};b.getState=x=function(I,J){return I===h||typeof I==="boolean"?y(I):y(J)[I]};b.removeState=function(I){var J={};if(I!==h){J=x();$.each($.isArray(I)?I:arguments,function(L,K){delete J[K]})}s(J,2)};e[d]=$.extend(e[d],{add:function(I){var K;function J(M){var L=M[F]=c();M.getState=function(N,O){return N===h||typeof N==="boolean"?m(L,N):m(L,O)[N]};K.apply(this,arguments)}if($.isFunction(I)){K=I;return J}else{K=I.handler;I.handler=J}}})})(jQuery,this);
/*
 * jQuery hashchange event - v1.3 - 7/21/2010
 * http://benalman.com/projects/jquery-hashchange-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,e,b){var c="hashchange",h=document,f,g=$.event.special,i=h.documentMode,d="on"+c in e&&(i===b||i>7);function a(j){j=j||location.href;return"#"+j.replace(/^[^#]*#?(.*)$/,"$1")}$.fn[c]=function(j){return j?this.bind(c,j):this.trigger(c)};$.fn[c].delay=50;g[c]=$.extend(g[c],{setup:function(){if(d){return false}$(f.start)},teardown:function(){if(d){return false}$(f.stop)}});f=(function(){var j={},p,m=a(),k=function(q){return q},l=k,o=k;j.start=function(){p||n()};j.stop=function(){p&&clearTimeout(p);p=b};function n(){var r=a(),q=o(m);if(r!==m){l(m=r,q);$(e).trigger(c)}else{if(q!==m){location.href=location.href.replace(/#.*/,"")+q}}p=setTimeout(n,$.fn[c].delay)}$.browser.msie&&!d&&(function(){var q,r;j.start=function(){if(!q){r=$.fn[c].src;r=r&&r+a();q=$('<iframe tabindex="-1" title="empty"/>').hide().one("load",function(){r||l(a());n()}).attr("src",r||"javascript:0").insertAfter("body")[0].contentWindow;h.onpropertychange=function(){try{if(event.propertyName==="title"){q.document.title=h.title}}catch(s){}}}};j.stop=k;o=function(){return a(q.location.href)};l=function(v,s){var u=q.document,t=$.fn[c].domain;if(v!==s){u.title=h.title;u.open();t&&u.write('<script>document.domain="'+t+'"<\/script>');u.close();q.location.hash=v}}})();return j})()})(jQuery,this);
</script>
<script src="/courses/course-search.js" type="text/javascript"></script>
<script src="/courses/bbq.js" type="text/javascript"></script>

<!-- GA TRACKING CODE HERE -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15032192-1']);
  _gaq.push(['_setDomainName', 'scu.edu.au']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!--<noscript>Your browser does not support JavaScript!</noscript>-->
</body>
</html>

