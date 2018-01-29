<!-- *** START OF STYLESHEET *** -->

<!-- **********************************************************************
 XSL to format the search output for Google Search Appliance
     ********************************************************************** -->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
<xsl:include href="env_variables"/>

<xsl:template name="header_element">
  <!-- *** replace the following with your own xhtml code or replace the text
   between the xsl:text tags with html escaped html code *** -->
  <xsl:text disable-output-escaping="yes">
  [[HEADER_CONTENTS]]
</xsl:text>
</xsl:template>
<xsl:template name="main_content_wrapper_start">
<xsl:text disable-output-escaping="yes">
&lt;main id=&quot;main&quot;&gt;
&lt;div class=&quot;container&quot; data-page=&quot;&quot;&gt;
</xsl:text>
</xsl:template>
<xsl:template name="main_content_wrapper_end">
<xsl:text disable-output-escaping="yes">
&lt;/div&gt;
&lt;/main&gt;
</xsl:text>
</xsl:template>
<xsl:template name="my_page_js">
<xsl:text disable-output-escaping="yes">
[[JS_CONTENTS]]
&lt;script type=&quot;text/javascript&quot;&gt;
jQuery.fn.extend({
    animateNav: function (slider,indicator) {
       if (!($(this).hasClass(&apos;collapsed&apos;))) 
        {
            $(slider).slideUp();
            $(this).addClass(&apos;collapsed&apos;);
            $(indicator + &apos;.collapse&apos;).addClass(&apos;open&apos;);
            $(indicator + &apos;.collapse&apos;).removeClass(&apos;collapse&apos;);
            $(indicator + &apos;.open&apos;).text(&apos;+&apos;);
        } 
        else 
        {
            $(slider).slideDown();
            $(this).removeClass(&apos;collapsed&apos;);
            $(indicator + &apos;.open&apos;).addClass(&apos;collapse&apos;);
            $(indicator + &apos;.open&apos;).removeClass(&apos;open&apos;);
            $(indicator + &apos;.collapse&apos;).text(&apos;-&apos;);
        }
        return false;;
    }
});
$(window).ready(function() {
  $(&apos;span.collapse&apos;).text(&apos;-&apos;);
  $(&apos;span.collapse&apos;).show();
  
  $(&apos;.dn-hdr&apos;).click(function(){$(this).animateNav(&apos;#dyn_nav_col&apos;, &apos;span&apos;);});

    $(&apos;.dn-attr-hdr&apos;).click(function(){
      var $parent = $(this).parent();
      var closed = $parent.hasClass(&apos;isClosed&apos;);
      if (closed) {
        $parent.removeClass(&apos;isClosed&apos;);
        $parent.addClass(&apos;isOpen&apos;);
      } else {
        $parent.removeClass(&apos;isOpen&apos;);
        $parent.addClass(&apos;isClosed&apos;);
      }
      });

});
&lt;/script&gt;
</xsl:text>
</xsl:template>

<xsl:template name="my_page_css">
<xsl:text disable-output-escaping="yes">
&lt;link href=&quot;//fonts.googleapis.com/css?family=Roboto:400,500,900&quot; rel=&quot;stylesheet&quot;/&gt;
[[CSS_CONTENTS]]
&lt;style type=&quot;text/css&quot;/&gt;
/** GLOBAL **/

@import url(https://fonts.googleapis.com/css?family=Roboto:300,400);
input,body,td,div,.p,a,.d,.s{font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;}
body,.d,.p,.s{background-color:transparent;}
.s{font-size: 80%;}
.g{margin-top: 15px; margin-bottom: 0px;}
.s td{width:34em}
.l{color: #005e86;}
.f,.f:link,.f a:link{color:#7777cc}
a:active,.f a:active{color:#ff0000}
.t{color:#000000}
.t{background-color:#3366cc}
.z{display:none}
.i,.i:link{color:#a90a08}
.a,.a:link{color:#008000}
div.n {margin-top: 1ex}
.n a{font-size: 10pt; color:#000000}
.n .i{font-size: 10pt; font-weight:bold}
.q a:visited,.q a:link,.q a:active,.q {color:black;}
input.q {padding-left:4px;}
.b,.b a{font-size: 12pt; color:#0000cc; font-weight:bold}
.d{margin-right:1em; margin-left:1em;}
div.oneboxResults {margin-top: 1em;}
.header__search,.z{display:none}
.ac-renderer {
  background: white;
  border-bottom: 1px solid #558BE3;
  border-left: 1px solid #A2BFF0;
  border-right: 1px solid #558BE3;
  border-top: 1px solid #A2BFF0;
  min-width: 200px;
  max-width: 400px;
  overflow-x: hidden;
  z-index: 10;
  position: absolute;
}
/**SDA-3146 refactor**/
header #head-nav {margin-right: 21%;}
.quicklinkshd a,.quicklinkshd a:visited { color: #fff; }

.main-content{
  max-width:960px; 
  margin: 0 auto; 
  margin-top:15px;
  /*box-shadow: 0px 0px 15px #C1C7CF;*/
  background-color: white;
    /*min-height: 800px;*/
}

#logo-div{
float: left;
}

#result_page_header_id, #centeredmenu {
  padding-left: 5px;
  padding-right: 5px;
}

#cached_page_header_div{
  border:1px;
  background-color:#ffffff;
  color:#ffffff;
  padding: 10px;
}
.caps{
  text-transform: capitalize;
}


/*#advanced-search-options-div{
  bgcolor:#cbdced;
}*/

#desktop_tab_div{
  padding: 4px;
}

#swr_div{
  padding: 4px;
}

#middle_div_search_box{
  float:left;
}

#middle_div{
  margin-top:2px;
  width:80%;
}
#middle_div_search_button{
  margin-top:2px;
}
#middle_div_search_button{
  float:left;
}
#last_div_secure{
  margin-bottom:5px;
  
}
#last_div_secure{
  margin-bottom:32px;
}
.cluster_col{
    float: left;
    margin: 5px;
    width: auto;
    height: auto;
}
.cluster-ul{
  list-style-type: none;
}
.cluster_list {
  padding-left: 0;
  padding-right: 1em;
}

.pull-right{
  text-align:right;
  float:right;
}
.pull-left{
  float:left;
  
}
.sort-by{
  text-align:right;
  float:right;
}
.main-div
{
  margin-top: 0;
  padding-left: 0;
  width: 90%;
}
.keymatch{
  min-height:40px;
  background-color:#ffce00;
  padding:5px;
  margin-bottom:5px;
}

span.keymatch-desc {
  font-size: 0.9em;
  display: block;
  padding: 0.5em 0;
}

.seperator-bar{
    background-color: #F5F8FF;
    min-height: 20px;
    padding: 10px;
}

.top_sep_bar{
  margin-top:20px;
}

.timing{
  margin-left:2px;
  padding-top:2px;
}

.main-results-without-dn{
  padding-left: 10px;
}

.search-label{
  float:left;
  margin-right:20px;
}

ul.n-ul {
  padding: 0;
  line-height: 1.5em;
  font-size: 90%;
}

ul.n-ul li {
  display: inline;
  margin-right: 2px;
}

ul.n-ul li span.i {
  background: none #ddd;
  color: #000;
  font-weight: normal;
  text-shadow: none;
  border-color: #AAA;
}

ul.n-ul li a, ul.n-ul li a:visited, ul.n-ul li span {
  background-color: #005e86;
  border: 1px solid #036;
  border-radius: 3px;
  color: #FFF;
  padding: 3px;
  text-decoration: none;
}


.home-page-hr{
  margin-top:20px;
}
/* TODO: this stops it overlaying the expert results but fixing at 50% is a bit inflexible */
div #left-side-container {
  width: 68%;
  margin-left: 215px;
}
#sidebar-container {
  float: right;
  display:none; 
  border-left: 1px solid rgb(211, 225, 249);
  margin: -8px 0 0 8px;
  padding: 0 0 0 1em;
  position: relative;
  z-index: 100;
  background: #FBFBFB;
}

#sidebar-container div h2 { border: none; }
#sidebar-container ol {padding: 0; margin: 0;}

.clearfix {
  clear: both;
}

/*#search_box_div{
  height:60px;
  padding: 20px;
}*/

input.search-box {
  height: 1.5em;
  line-height: 1.5em;
  border: none;
  margin: 1px;
  font-size: 1.5em;
  padding: 0;
  width: 80%;
  outline: none;
}

.glass:hover { background: #F5F5F5; }
.glass {
  background-color: #FFF;  
  padding: 0;
  border-radius: 0 15px 15px 0;
  height: 25px;
  width: 25px;
  float: right;
  margin: 1% 1% 0 0;
}

#query_suggestions_div {
    width: 80%;
    border-style: solid;
    border-color: #AAA;
    padding-left: 10px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    border-width: 2px;
    margin: 10px auto;
}

div.copyright {
  margin: 0 auto 20px auto;
  width: 100%;
  background-color: #F5F8FF;
  padding: 1em 0;
  text-align: center;
  font-size: 0.8em;
  display: none;
}

div.dn-hdr span.collapse, div.dn-hdr span.open { float: right; font-weight:bold; position:relative;}
span.collapse { font-size: 2.3em; top: -3px; }
span.open { font-size: 1.6em; left: 2px;  top: 1px; }

.main-results .result-item p { margin: 0; font-size: 0.9em; }
span.mime {font-size: 0.85em;position: relative;top: -2px;}
#bottom-navigation li {margin: 0 1px;}
#bottom-navigation ul li a:hover { color: #000; font-weight: bold; background: #ffce00; border-color: #E4A702; text-shadow: 2px 1px 2px transparent; }
.col p#spell-suggest {margin: 6px 0 6px;}
#spell-suggest span, .no-results h1 { color: #cc0000; }
 .index-details{ color: #008000; }
#sidebar-container ol li,span.powered-by,#results_cluster_div,.snippet-details,#spell-suggest,.main-content .no-results ul li,.main-content .no-results p,.search-stats,.index-details {font-size: 1.1em;}
.no-results,.search-stats{word-wrap: break-word;}
.no-results {width: 45%; margin: 1em auto;}
.no-results p {display: block;}
h1, h2 {font-family: sans-serif;}
.main-content .no-results ul li {line-height: 1em;}
 
.access-type { margin-right: 1em; }

#global-nav-list li,.search-stats { display: none; }

#global-nav-list li#course-search { display: block; font-size: 1.6em; }

.access-container {
  display: block;
    width: 100%;
    position: relative;
    margin-left: 2em;
    top: -1em;
}

.access-type label, .access-type { float: left; clear:left; }
.access-type input { width: 24px; }

/** skin class styles : these are populated by the skin GET param**/

.zd #search_box_div, .zd header, .zd footer, .zd #quicklinks, .bb header, .bb footer, .bb #quicklinks, .bb #search_box_div { display: none; }

.zd body, .zd, .bb, .bb body, .zd #container #content-after { background: none; }

.zd #container { box-shadow: none;}

.bb #container #content-after { background: none; }
.bb #container { box-shadow: none; }

.access-container label { margin: 0 1em; }

@media only screen and (min-width: 480px) {
  ul.n-ul li a, ul.n-ul li a:visited, ul.n-ul li span { padding: 5px 10px; }
  .access-container {margin: 0 auto;width: 50%;top: 0px;}
  input.search-box { width: 86%; }
  #global-nav-list li,.search-stats  { display: block; }
  #global-nav-list li#course-search { font-size: 1em; }
  .access-type label, .access-type { float: none; }
}

@media only screen and (min-width: 992px) {
    .access-container {width: 40%;}
}

@media only screen and (min-width: 768px) {
  .glass {height: 16px;width: 16px;}
  input.search-box { width: 90%; }

 }
@media only screen and (min-width: 996px) {
  #sidebar-container { width: 46%; display: block; }
}

 /** DYNAMIC NAVIGATION **/
 .filter-title {
    margin: 0 auto;
    background: #CEDAED;
    padding: 15px 22px;
} 
#main_res {
  background: #FFF none repeat scroll 0 0;
  width: 97%;
  float:left;
  margin-left:10px;
}
#main_res p {
  margin-top: 0;
}
#dyn_nav {
  background: #E5ECF9 none repeat scroll 0 0;
  float:left;
  padding-top: 1px;
  width: 97%;
  margin-left: 10px;
}
.dn-hdr {
  background-color: #005e86;
  padding: 1em;
  color: #FFF;
  font-size: 1.2em;
  line-height: 18px;
  margin: 0px;
  text-align: left;
  cursor: pointer;
}
/* Expert Search - add custom style for go back to main results link
   displayed in expert search expanded mode with dynamic navigation. */
.dn-exp {
  font-size: 12px;
  margin: 10px 0;
  padding-left: 6px;
}
.dn-img {
  background: transparent url("/SCU-template/img/clear-left.png") no-repeat scroll 0 0;
  border: 0 none;
  height: 22px;
  width: 22px;
  position: relative;
}
a.dn-r-img {
  float: right;
}
#dyn_nav ul, li {
  list-style-image: none;
  list-style-position: outside;
  list-style-type: none;
  vertical-align: middle;
}
#dyn_nav li {font-size: 1.2em;}
ul.dn-attr {
  background: #E5ECF9 none repeat scroll 0 0;
  padding-left: 0px;
}
ul.dn-attr-hidden {
  background: #E5ECF9 none repeat scroll 0 0;
  margin: 0;
  padding: 4px 0 0 0;
}
.label-input-label {
  color: GrayText;
}  
li.dn-attr-hdr {
  font-weight: bold;
  line-height: 1.1;
  outline-style: none;
  display: block;
  margin: 0;
  padding: 15px 15px;
  background-color: #CEDAED;
  position:relative;
}
.dn-attr-hdr:after {
    content: " ";
    width: 14px;
    height: 14px;
    position: absolute;
    cursor: pointer;
    top: 50%;
    right: 15px;
    margin-top: -7px;
    background-image: url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2214%22%20height%3D%2214%22%20viewBox%3D%220%200%2014%2014%22%3E%3Cpath%20fill%3D%22%235275ba%22%20d%3D%22M6.9%200L5.2%201.8l3.9%204H0v2.5h9.1l-3.9%204L6.9%2014%2014%207%22%2F%3E%3C%2Fsvg%3E');
    -webkit-transition: -webkit-transform 0.3s ease-out;
    transition: -webkit-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}
.isClosed .dn-attr-hdr:after {
    transform: none;
}
.isClosed .dn-attr-v, .isClosed li[id*=&quot;more&quot;] {
    display: none;
    margin: 0 0 2px 0;
}
.dn-attr-hdr-txt {
  display: inline-block;
  overflow: hidden;
  width: 85%;
  /* line-height: 1.7em; */
  /* font-size: 1.7em; */
  padding: 0;
}
li.dn-attr-hdr div {
  width: 100%;
}
input.dn-zippy-input {
  border-style: none;
  font-size: 1em;
  margin-bottom: 2px;
  margin-left: 3px;
  margin-top: 1px;
  width: 87%;
  padding: 5px;
}
div.dn-zippy-hdr {
  cursor: pointer;
  outline-style: none;
}
/**li.dn-attr-hdr div.dn-zippy-hdr-img {
  background: url("/images/ic_search.png") no-repeat scroll 0 0 transparent;
  float: right;
  height: 12px;
  margin-right: 4px;
  width: 10px;
}**/
ul.dn-attr a, a.dn-bar-link {
  color: #005e86;
  text-decoration: none;
}
.dn-hidden {
  display: none;
}
.dn-inline-block, .dn-bar-rt, .dn-bar-rt table, .dn-img, span.dn-more-img {
  display: inline-block;
}
.dn-block {
  display: block;
}
.ac-renderer div {
  cursor: pointer;
}
.ac-renderer div b {
  color: #3366FF;
}
.ac-renderer div.active {
  background-color: #D5E2FF;
  color: #000;
}
span.dn-attr-c {
  color: #000;
  margin: 0 5px;
}
.dn-attr-txt {
  display: inline-block;
  margin-right: 5px;
}
.dn-attr-v {
  overflow-x: hidden;
  width: 94%;
  margin: 6px 1em 0 1em;
}
.dn-attr-txt {text-decoration: underline;}
a.dn-attr-a:visited, a.dn-bar-link:visited {
  color: #005e86;
}
a.dn-attr-a:hover {
  text-decoration: underline;
}
a.dn-link, .dn-img {
  outline-style: none;
}
.dn-overflow {
  overflow-x: hidden;
  /** same line height as the clear gfx **/
  line-height: 22px;
}
.dn-bar-v {
  color: #000;
}
.dn-bar-rt {
  border: 0 none;
  float: right;
  margin: -2px 5px 0 20px;
}
.dn-bar-nav {
  font-size: 80%;
}
.dn-more-img {
  height: 15px;
  margin-right: 1px;
  overflow: hidden;
  position: relative;
  vertical-align: text-bottom;
  width: 15px;
}

.dn-bar {
  background-color: transparent;
  clear: both;
  font-size: 1.25em;
  margin: 6px 0 6px;
  display:none;
}
.dn-bar dfn {
  font-size: 1.2em;
  padding: 4px;
}
.dn-bar a.cancel-url:hover {
  text-decoration: line-through;
}
.main-results {
  margin-top: 8px;
}
.oneboxResults table {
  width: 100%;
}
.ss-gac-d, .ss-gac-c { padding: 0.5em; }
.ss-gac-d { background: #005e86; color: #FFF; width: 100%; }
ul.dn-attr-hidden { font-size: 0.8em; }
.isClosed ul.dn-attr-hidden { padding: 0; }

@media only screen and (min-width: 768px) {
 #main_res {width: 64%; float: right;}  
 #dyn_nav {width: 33%;}
 .dn-bar {display:block;}
}
@media only screen and (min-width: 992px) {
 #main_res{width: 69%;}
 #dyn_nav {width: 28%;}
}
 

/** DOCUMENT_PREVIEW **/
.result-item {
  position: relative;
  font-size: 1.3em;
  border-bottom: 1px solid #EEE;
  padding: 0.5em;
}
.non-previewable {
  background-color: transparent !important;
  border: 1px solid white !important;
}
.non-previewable .s {
  background-color: transparent !important;
}
div.result-item .dps-viewer {
  margin: 0;
}
body.previews-enabled div.result-item-hover {
  background-color: #ebf2fc;
  border: 1px solid #cddcf9;
}
body.previews-enabled div.result-item-hover .s {
  background-color: #ebf2fc !important;
}
span.toggle-preview {
  display: inline-block;
  margin-left: 5px;
  cursor: pointer;
  width: 10px;
  height: 10px;
  background: url("/preview_off.png");
}
div.result-item-hover span.toggle-preview {
  color: #0000cc;
  background-image: url("/preview_on.png");
}
body.previews-enabled span.toggle-preview {
  color: #0000cc !important;
  background-image: url("/preview_on.png");
}

/** TRANSLATION **/
.skiptranslate,.goog-te-sectional-gadget-link div,.goog-te-sectional-gadget-all div {
  display: inline;
}
.goog-te-sectional-gadget-link .goog-te-gadget-link {
  background-color: #E5ECF9;
  border: 1px solid #DCDCFF;
  border-radius: 3px 3px;
  color: #03C;
  padding: 0px 5px;
  -moz-border-radius: 3px 3px;
}
span.goog-te-sectional-gadget-link-text {
  font-size: 80%;
  font-weight: normal;
}
.trns-span, .trns-cache-link {
  display: none;
  margin-right:5px;
}
.trns-all-div {
  display: none;
  padding-top: 15px;
  padding-bottom: 10px;
}
.goog-te-sectional-gadget-all .goog-te-gadget-link {
  color: #03C;
  padding-right: 22px;
  padding-left: 7px;
}
.goog-te-sectional-gadget-all-logo {
  padding-left: 7px;
}

/** COLLECTION_TABS **/
#centeredmenu {
   width:90%;
   background:#fff;
   overflow:hidden;
   position:relative;
   display: block;
   margin: 1em auto 0;
}
#centeredmenu ul {
   clear:left;
   float:left;
   list-style:none;
   margin:0;
   padding:0;
   position:relative;
   left:50%;
   text-align:center;
}
#centeredmenu ul li {
   display:block;
   float:left;
   list-style:none;
   margin:0;
   padding:0;
   position:relative;
   right:50%;
}
#centeredmenu ul li a {
   display:block;
   margin:0 0 0 1px;
   padding:10px 15px;
   background:#DCE4F5;
   color:#005e86;
   font-weight: bold;
   text-decoration:none;
   line-height:1.3em;
   font-size:1.3em;
}
#centeredmenu ul li a:hover {
   background:#005e86;
   color:#fff;
}
#centeredmenu ul li a.active,
#centeredmenu ul li a.active:hover {
   color:#000000 !important;
   background:#000;
   font-weight:bold;
}

.active{
   background:#F5F8FF !important;
}
#centeredmenu ul li.staff_directory, #centeredmenu ul li.policies {
    display: none;
}

@media only screen and (min-width: 768px) {
 #centeredmenu ul li.staff_directory, #centeredmenu ul li.policies {
    display: block;
}
}

/** RES_CLUSTER_TOP **/
div#clustering {font-size: 84%; line-height: 140%; min-height: 4.6em; _height: 4.6em; margin-top: 1em;}
div#clustering h3 {font-size: 100%; font-weight: bold; margin: 0; padding: 0;}
div#clustering table {margin-left: 2em; font-size: 100%;}
div#clustering table a {white-space: nowrap;}
div#clustering table td {padding-right: 1em;}
div#clustering #cluster_status {color: #666666; margin-left: 2em;}

/** MAIN STYLE OVERRIDE **/
.header-top-bar-wrap .main-links > li { float: left; }
.header__search-toggle { display: none; }
.bg-bar-wrap { display: none; }
@media (max-width: 767px) {
	.header-main-wrap { z-index: 2; }	
}
@media (min-width: 768px) {
	.bg-bar-wrap { display: block; }
}
.main-links { text-align: left; }

&lt;/style&gt;
</xsl:text>
</xsl:template>
<xsl:template name="footer_element">
<xsl:text disable-output-escaping="yes">
[[FOOTER_CONTENTS]]
</xsl:text>
</xsl:template>
</xsl:stylesheet>



