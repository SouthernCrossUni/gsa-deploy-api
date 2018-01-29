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
&lt;header class=&quot;clearfix&quot;&gt;
&lt;nav id=&quot;global-nav&quot; aria-label=&quot;Primary Top&quot; class=&quot;clearfix&quot;&gt;
&lt;ul id=&quot;global-nav-list&quot;&gt;
    &lt;li id=&quot;home&quot; class=&quot;no-expand&quot;&gt;&lt;a onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C1-Home&apos;]);&quot; href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;&lt;li id=&quot;future&quot;&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/&quot;&gt;Future Students&lt;/a&gt;
        &lt;div class=&quot;global-nav-links no-expand&quot; data-width-mod=&quot;1918&quot; style=&quot;visibility: hidden;&quot;&gt;
        &lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS&apos;]);&quot;&gt;Future students home&lt;/a&gt;
&lt;a href=&quot;http://search.scu.edu.au/courses/#year=2016&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-2016CouOpt&apos;]);&quot;&gt;2016 course options &lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scuinfodays/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-InfoDays&apos;]);&quot;&gt;SCU Info Days  &lt;sup class=&quot;minilabel&quot; style=&quot;font-size: 8px;&quot;&gt; NEW &lt;/sup&gt;&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/distance/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-DisEdu&apos;]);&quot;&gt;Distance and online&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/howtoapply/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-HowToApp&apos;]);&quot;&gt;How to apply&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/fees/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-Fees&apos;]);&quot;&gt;Fees&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/campustours/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-CamTou&apos;]);&quot;&gt;Campus tours&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/index.php/20/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-Acc&apos;]);&quot;&gt;Accommodation&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scholarships/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-Sch&apos;]);&quot;&gt;Scholarships&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scupathways/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-AdvStaPat&apos;]);&quot;&gt;Advanced standing and pathways&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">college.scu.edu.au/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C2-FS-SCUCol&apos;]);&quot;&gt;SCU College&lt;/a&gt;&lt;/div&gt;
    &lt;/li&gt;    &lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/&quot;&gt;International&lt;/a&gt;
        &lt;div class=&quot;global-nav-links no-expand&quot; data-width-mod=&quot;1918&quot; style=&quot;visibility: hidden;&quot;&gt;
        &lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int&apos;]);&quot;&gt;International home&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/index.php/220/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-1&apos;]);&quot;&gt;International course options  &lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/apply/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-2&apos;]);&quot;&gt;How to apply&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/studyabroad/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-InboundStudents&apos;]);&quot;&gt;Inbound students&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/exchange/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-OutboundStudents&apos;]);&quot;&gt;Outbound students&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/index.php/186/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-4&apos;]);&quot;&gt;Living in Australia&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/agents/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-6&apos;]);&quot;&gt;Agents&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/englishlanguage/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-7&apos;]);&quot;&gt;English programs&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/index.php/82/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C3-Int-8&apos;]);&quot;&gt;International and Enterprise&lt;/a&gt;
        &lt;/div&gt;
&lt;/li&gt;    &lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/&quot;&gt;Students&lt;/a&gt;
        &lt;div class=&quot;global-nav-links no-expand&quot; data-width-mod=&quot;1918&quot; style=&quot;visibility: hidden;&quot;&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS&apos;]);&quot;&gt;Students home&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/gettingstarted/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-NewStu&apos;]);&quot;&gt;New students&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/index.php/42/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-Enr&apos;]);&quot;&gt;Enrolling&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/index.php/4/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-StuAdm&apos;]);&quot;&gt;Student administration&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/index.php/47/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-StuRe&apos;]);&quot;&gt;Study resources&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/index.php/109/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-Ser&apos;]);&quot;&gt;Services and support&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/travel/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-Tra&apos;]);&quot;&gt;Travel to SCU&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/activities/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-Act&apos;]);&quot;&gt;Culture, sport and recreation&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/index.php/108/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-Opp&apos;]);&quot;&gt;Opportunities&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/index.php/10/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-GraBey&apos;]);&quot;&gt;Graduation and beyond&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/contact/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C4-CS-Con&apos;]);&quot;&gt;Contact us&lt;/a&gt;
        &lt;/div&gt;
&lt;/li&gt;&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/research/&quot;&gt;Research&lt;/a&gt;
        &lt;div class=&quot;global-nav-links no-expand&quot; data-width-mod=&quot;1918&quot; style=&quot;visibility: hidden;&quot;&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/research/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res&apos;]);&quot;&gt;Research home&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/graduateschool/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res-GradSch&apos;]);&quot;&gt;Graduate School&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/research/index.php/60/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res-ResSerGra&apos;]);&quot;&gt;Research services and grants&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/graduateschool/index.php/12/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res-HowToApp&apos;]);&quot;&gt;How to apply&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/research/index.php/40/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res-Eth&apos;]);&quot;&gt;Ethics&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/research/index.php/66/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res-ResCenCRN&apos;]);&quot;&gt;Research centres/CRN&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/geoscience/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res-SCGS&apos;]);&quot;&gt;Southern Cross GeoScience&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scps/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C5-Res-SCPS&apos;]);&quot;&gt;Southern Cross Plant Science&lt;/a&gt;
        &lt;/div&gt;
&lt;/li&gt;    &lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/space/&quot;&gt;Community&lt;/a&gt;
        &lt;div class=&quot;global-nav-links no-expand&quot; data-width-mod=&quot;1918&quot; style=&quot;visibility: hidden;&quot;&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/space/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com&apos;]);&quot;&gt;Community home&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/sustainability/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-Sus&apos;]);&quot;&gt;Sustainability&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/space/index.php/4/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-ComEng&apos;]);&quot;&gt;Community engagement&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/news/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-SCUnews&apos;]);&quot;&gt;SCU news&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scunews/index.php/31/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-SCUSocMed&apos;]);&quot;&gt;SCU on social media&lt;/a&gt;
&lt;a href=&quot;http://discover.scu.edu.au/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-DisEne&apos;]);&quot;&gt;Discover eNews&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/events/index.php/events/all/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-Eve&apos;]);&quot;&gt;Events&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/alumni/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-Alu&apos;]);&quot;&gt;Alumni&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/experts/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-FinAnExp&apos;]);&quot;&gt;Find an expert&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/risingstars/index.php/4/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C6-Com-RisStaPro&apos;]);&quot;&gt;Rising Stars program&lt;/a&gt;
        &lt;/div&gt;
&lt;/li&gt;    &lt;li style=&quot;padding-right:11px;&quot;&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/about/&quot;&gt;About Us&lt;/a&gt;
        &lt;div class=&quot;global-nav-links no-expand&quot; data-width-mod=&quot;1918&quot; style=&quot;visibility: hidden;&quot;&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/about/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C7-Ab&apos;]);&quot;&gt;About Us home&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/schools/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C7-Ab-AcaSch&apos;]);&quot;&gt;Academic schools&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/campuses/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C7-Ab-Loc&apos;]);&quot;&gt;Locations&lt;/a&gt; &lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/jobs/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C7-Ab-Jobs&apos;]);&quot;&gt;Jobs @ SCU&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/about/index.php/46/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C7-Ab-SCUexe&apos;]);&quot;&gt;SCU Executives&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/staffdirectory/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C7-Ab-StaDir&apos;]);&quot;&gt;Staff Directory&lt;/a&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/contact/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C7-Ab-ConUs&apos;]);&quot;&gt;Contact Us&lt;/a&gt;
        &lt;/div&gt;
&lt;/li&gt;&lt;li id=&quot;course-search&quot; class=&quot;hide no-expand&quot; style=&quot;padding-right:14px;padding-left:14px;&quot;&gt;&lt;a href=&quot;http://search.scu.edu.au/courses/#year=2016&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Nav&apos;, &apos;Click&apos;, &apos;C8-FindACourse&apos;]);&quot;&gt;Find a Course&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;div style=&quot;clear:both&quot;&gt;&lt;/div&gt;
&lt;/nav&gt;
&lt;div id=&quot;banner&quot; role=&quot;navigation&quot; aria-label=&quot;Secondary Top&quot; class=&quot;shadey&quot;&gt;
&lt;h1 id=&quot;SCU-logo&quot; tabindex=&quot;1&quot;&gt;
&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;,&apos;GH-Logo&apos;,&apos;Click&apos;,&apos;SCU_Logo&apos;]);&quot;&gt;Southern Cross 
&lt;br&gt;
&lt;span class=&quot;second&quot;&gt;University&lt;/span&gt;
&lt;span class=&quot;printOnly&quot; id=&quot;slogan&quot;&gt;It&apos;s all about U&lt;/span&gt;
&lt;img id=&quot;logo-lo&quot; src=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/SCU-template/img/logo/SCU-Logo-White.png&quot; alt=&quot;Southern Cross University&quot;&gt;
&lt;img id=&quot;logo-hi&quot; src=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/SCU-template/img/logo/_SCU_logo@2x.png&quot; alt=&quot;&quot; style=&quot;display: none;&quot;&gt;
&lt;/a&gt;
&lt;/h1&gt;
&lt;nav id=&quot;head-nav&quot;&gt;
&lt;ul&gt;
&lt;li tabindex=&quot;2&quot;&gt;&lt;a href=&quot;//learn.scu.edu.au/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Icons&apos;, &apos;Click&apos;, &apos;01-MySCU&apos;]);&quot;&gt;MySCU&lt;/a&gt;&lt;/li&gt;
&lt;li tabindex=&quot;3&quot;&gt;&lt;a href=&quot;//email.scu.edu.au/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Icons&apos;, &apos;Click&apos;, &apos;02-Email&apos;]);&quot;&gt;Email&lt;/a&gt;&lt;/li&gt;
&lt;li tabindex=&quot;4&quot;&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/library/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Icons&apos;, &apos;Click&apos;, &apos;03-Library&apos;]);&quot;&gt;Library&lt;/a&gt;&lt;/li&gt;
&lt;li tabindex=&quot;5&quot;&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/services/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Icons&apos;, &apos;Click&apos;, &apos;04-AZ&apos;]);&quot;&gt;A-Z&lt;/a&gt;&lt;/li&gt;
&lt;li tabindex=&quot;6&quot;&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/contact/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-Icons&apos;, &apos;Click&apos;, &apos;05-Contact&apos;]);&quot;&gt;Contact&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;/nav&gt;
&lt;/div&gt;
&lt;/header&gt;

&lt;section id=&quot;quicklinks&quot; aria-labelledby=&quot;quicklinksheading&quot;&gt;
&lt;span class=&quot;quicklinkshd&quot;&gt;&lt;a href=&quot;file:///&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;,&apos;GH-QL&apos;,&apos;Click&apos;,&apos;QL&apos;]);&quot;&gt;Quick Links&lt;/a&gt;&lt;/span&gt;
&lt;nav&gt;
&lt;ul&gt;
&lt;li style=&quot;font-size: 12px;font-weight: bold;text-transform: uppercase;&quot;&gt;General&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/services/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-01&apos;]);&quot;&gt;A-Z of SCU&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/academicboard/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-02&apos;]);&quot;&gt;Academic Board&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/schools/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-03&apos;]);&quot;&gt;Academic Schools&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/academicskills/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-04&apos;]);&quot;&gt;Academic Skills&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/equity/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-05&apos;]);&quot;&gt;Equity and Diversity Office&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/jobs/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-06&apos;]);&quot;&gt;Jobs @ SCU&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/news/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-07&apos;]);&quot;&gt;Media Releases&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/policy/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-08&apos;]);&quot;&gt;SCU Policy Library&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/staff/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-09&apos;]);&quot;&gt;Staff Directory&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/it/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-10&apos;]);&quot;&gt;Technology Services&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://staff.uat.scu.edu.au/vc/index.php/dds/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C3-11&apos;]);&quot;&gt;VC&apos;s Weekly Updates&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;ul&gt;
&lt;li style=&quot;font-size: 12px;font-weight: bold;text-transform: uppercase;
&quot;&gt;Current Students&lt;/li&gt;

&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/library/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-Library&apos;]);&quot;&gt;Library&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/myenrolment/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-MyEnrolment&apos;]);&quot;&gt;My Enrolment&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/students/index.php/107/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-Out-of-HoursCrisisSupportLine&apos;]);&quot;&gt;Out-of-Hours Crisis Support Line&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/pcfinder/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-PCFinder&apos;]);&quot;&gt;PC Finder&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/scheduleofunits&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-ScheduleofUnits&apos;]);&quot;&gt;Schedule of Units&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/handbook/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-StudentHandbook&apos;]);&quot;&gt;Student Handbook&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/students/index.php/82/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-StudentRepresentation&apos;]);&quot;&gt;Student Representation&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/teachingcalendar/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-TeachingCalendar&apos;]);&quot;&gt;Teaching Calendar&lt;/a&gt;&lt;/li&gt;
&lt;li style=&quot;height:10px !important;&quot;&gt; &lt;/li&gt;
&lt;li style=&quot;font-size: 12px;font-weight: bold;text-transform: uppercase;&quot;&gt;STAFF&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://staff.uat.scu.edu.au/change/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-Change@SCU&apos;]);&quot;&gt;Change @ SCU&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/hr/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C2-HRServices&apos;]);&quot;&gt;HR Services&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;ul&gt;
&lt;li style=&quot;font-size: 12px;font-weight: bold;text-transform: uppercase;&quot;&gt;Future Students&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://search.scu.edu.au/courses/#year=2016&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-01&apos;]);&quot;&gt;2016 Course Options  &lt;sup class=&quot;minilabel&quot; style=&quot;font-size: 8px;&quot;&gt;NEW&lt;/sup&gt;&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/accommodation/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-02&apos;]);&quot;&gt;Accommodation Services&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/campustours/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-03&apos;]);&quot;&gt;Campus Tours&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/distance/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-04&apos;]);&quot;&gt;Distance and Online Study&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/enquiries/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-05&apos;]);&quot;&gt;Enquire Online&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/international/index.php/10/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-06&apos;]);&quot;&gt;International Course Options&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/postgraduate/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-07&apos;]);&quot;&gt;Postgraduate Course Options&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/preparingforsuccess/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-08&apos;]);&quot;&gt;Preparing for Success Program&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://uat.scu.edu.au/scholarships/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-09&apos;]);&quot;&gt;Scholarships&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">college.scu.edu.au/&quot; onclick=&quot;_gaq.push([&apos;_trackEvent&apos;, &apos;GH-QL&apos;, &apos;Click&apos;, &apos;QL-C1-10&apos;]);&quot;&gt;SCU College&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;/nav&gt;
&lt;script src=&quot;https://code.jquery.com/jquery-1.11.3.js&quot;&gt;&lt;/script&gt;
&lt;script src=&quot;http://uat.scu.edu.au/SCU-template/js/SCUlibs/SCU-template.js?v=1&quot;&gt;&lt;/script&gt;
&lt;script src=&quot;https://s3-ap-southeast-2.amazonaws.com/static-gsa/SCU-gsa.js?v=1.5&quot;&gt;&lt;/script&gt;
&lt;/section&gt;
</xsl:text>
</xsl:template>
<xsl:template name="my_page_css">
<xsl:text disable-output-escaping="yes">
&lt;link rel=&quot;stylesheet&quot; media=&quot;screen&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/style.css?v=3&quot;&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;screen&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/search.css?v=3&quot;&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;print&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/print.css?v=2&quot;&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen and (min-width: 480px)&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/480.css?v=2&quot;&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen and (min-width: 768px)&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/768.css?v=2&quot;&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen and (min-width: 992px)&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/992.css?v=2&quot;&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen and (min-width: 1382px)&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/1382.css?v=1&quot;&gt;
&lt;!-- For Retina displays --&gt;
&lt;!--[if !(IE)]&gt;&lt;!--&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2)&quot; type=&quot;text/css&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/2x.css?v=1&quot;&gt;
&lt;!--  For Retina Devices Specific to 480 wide --&gt;
&lt;!--  &lt;link rel=&quot;stylesheet&quot; media=&quot;only screen and (max-device-width: 480px) and and (-webkit-min-device-pixel-ratio: 2)&quot; href=&quot;///SCU-template/css/retina-480.css&quot; /&gt;--&gt;
&lt;!--  For Retina Devices Specific to 1024 wide --&gt;
&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen and (min-device-width: 768px) and (max-device-width: 1024px)&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/device-1024.css&quot; /&gt;&lt;!--&lt;![endif]--&gt;
&lt;!--[if lt IE 9]&gt;&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/ie/ltIE9.css&quot;&gt;&lt;![endif]--&gt;
&lt;!--[if lt IE 7]&gt;&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/ie/ltIE7.css&quot;&gt;&lt;![endif]--&gt;
&lt;!--[if IE 7 ]&gt;&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen&quot; href=&quot;&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/ie/IE7.css&gt;&lt;![endif]--&gt;
&lt;!--[if IE 8 ]&gt;&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/ie/IE8.css&quot;&gt;&lt;![endif]--&gt;
&lt;!--[if IE 8 ]&gt;&lt;link rel=&quot;stylesheet&quot; media=&quot;print&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/ie/IE8_print.css&quot;&gt;&lt;![endif]--&gt;
&lt;!--[if IEMobile 7]&gt;&lt;link rel=&quot;stylesheet&quot; media=&quot;only screen&quot; href=&quot;</xsl:text><xsl:value-of select="$scu_template_css_path"/><xsl:text disable-output-escaping="yes">/ie/IEMobile7.css&quot;&gt;&lt;![endif]--&gt;
</xsl:text>
</xsl:template>
<xsl:template name="main_content_wrapper_start">
<xsl:text disable-output-escaping="yes">
&lt;div id=&quot;body-container&quot;&gt;
</xsl:text>
</xsl:template>
<xsl:template name="main_content_wrapper_end">
<xsl:text disable-output-escaping="yes">
&lt;/div&gt;
</xsl:text>
</xsl:template>

<xsl:template name="footer_element">
<xsl:text disable-output-escaping="yes">
&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;https://s3-ap-southeast-2.amazonaws.com/static-gsa/scu-footer2.css&quot; /&gt;
&lt;div id=&quot;content-after&quot;&gt;&lt;/div&gt;
&lt;footer role=&quot;contentinfo&quot; class=&quot;clearfix&quot;&gt;
&lt;div class=&quot;footer-nav&quot;&gt;
&lt;nav&gt;
&lt;h4&gt;Most popular&lt;/h4&gt;
&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;http://search.scu.edu.au/courses/#year=2016&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;MP-2016CourseOptions&#039;]);&quot;&gt;2016 course options&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/index.php/220/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;MP-2016InternationalCourseOptions&#039;]);&quot;&gt;2016 international course options&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/index.php/20/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;MP-Accommodation&#039;]);&quot;&gt;Accommodation&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/distance/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;MP-DistanceOnlineStudy&#039;]);&quot;&gt;Distance and online study&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/it/messaging/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;MP-EmailCalendaring&#039;]);&quot;&gt;Email and calendaring&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/jobs/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;MP-Jobs&#039;]);&quot;&gt;Jobs @ SCU&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;h4&gt;Important&lt;/h4&gt;
&lt;ul&gt;
  &lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scuinfodays/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Imp-InfoDays&#039;]);&quot;&gt;SCU Info Days  &lt;sup class=&quot;minilabel&quot; style=&quot;font-size: 8px;&quot;&gt; NEW &lt;/sup&gt;&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/index.php/7/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Imp-Dates&#039;]);&quot;&gt;Key application dates&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/myenrolment/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Imp-MyEnrolment&#039;]);&quot;&gt;My Enrolment&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/orientation/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Imp-Orientation&#039;]);&quot;&gt;Orientation&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scholarships/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Imp-Scholarships&#039;]);&quot;&gt;Scholarships&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/news/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;MP-SCUNews&#039;]);&quot;&gt;SCU News&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;/nav&gt; &lt;nav&gt;
&lt;h4&gt;Courses&lt;/h4&gt;
&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/business-tourism/index.php/3/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-Bus&#039;]);&quot;&gt;Business&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/arts-social-sciences/index.php/2#course_cat_7090&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-CrePerArt&#039;]);&quot;&gt;Creative and Performing Arts&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/education/index.php/4/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-Edu&#039;]);&quot;&gt;Education&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/environment-science-engineering/index.php/22/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-ESE&#039;]);&quot;&gt;Environment, Science and Engineering&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/health-sciences/index.php/34/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-HHS&#039;]);&quot;&gt;Health and Human Sciences&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/arts-social-sciences/index.php/2/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-HSS&#039;]);&quot;&gt;Humanities and Social Sciences&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/gnibi-indigenous-studies/index.php/2/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-Ind&#039;]);&quot;&gt;Indigenous Studies&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/business-tourism/index.php/3/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-IT&#039;]);&quot;&gt;Information Technology&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/law-justice/index.php/5/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-Law&#039;]);&quot;&gt;Law and Justice&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">college.scu.edu.au/index.php/13/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-SCUC&#039;]);&quot;&gt;SCU College and Preparatory&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/business-tourism/index.php/3/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Courses-THM&#039;]);&quot;&gt;Tourism and Hospitality&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;h4&gt;Course information&lt;/h4&gt;
&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/index.php/dds#cat1634/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CI-2015StudyGuide&#039;]);&quot;&gt;2015 study guide&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/index.php/dds#cat1637/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CI-CourseBrochures&#039;]);&quot;&gt;Course brochures&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/courseguide/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CI-CouEnrGui&#039;]);&quot;&gt;Course enrolment guides&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scuinfodays/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CI-InfoDays&#039;]);&quot;&gt;SCU Info Days&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;/nav&gt; &lt;nav&gt;
&lt;h4&gt;Information for&lt;/h4&gt;
&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/alumni/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Info-Alumni&#039;]);&quot;&gt;Alumni&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/distance/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Info-DE&#039;]);&quot;&gt;Distance and online study&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/futurestudents/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Info-FS&#039;]);&quot;&gt;Future students&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/international/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Info-IS&#039;]);&quot;&gt;International students&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/postgraduate/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Info-PostgRes&#039;]);&quot;&gt;Postgraduate and research&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/students/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Info-Students&#039;]);&quot;&gt;SCU students&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/risingstars/index.php/3/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Info-ScholSupp&#039;]);&quot;&gt;Scholarship supporters&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;h4&gt;Connect with SCU&lt;/h4&gt;
&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scunews/index.php/31#facebook&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Connect-Facebook&#039;]);&quot;&gt;&lt;img src=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/SCU-template/img/share-sml/facebook-share-sml.png&quot; height=&quot;17&quot; width=&quot;17&quot; alt=&quot;Southern Cross University on Facebook&quot; title=&quot;Southern Cross University on Facebook&quot;&gt; Facebook&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scunews/index.php/31#twitter&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Connect-Twitter&#039;]);&quot;&gt;&lt;img src=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/SCU-template/img/share-sml/twitter-share-sml.png&quot; height=&quot;17&quot; width=&quot;17&quot; alt=&quot;Southern Cross University on Twitter&quot; title=&quot;Southern Cross University on Twitter&quot;&gt; Twitter&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scunews/index.php/31#linkedin&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Connect-LinkedIn&#039;]);&quot;&gt;&lt;img src=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/SCU-template/img/share-sml/linkedin-share-sml.png&quot; height=&quot;17&quot; width=&quot;17&quot; alt=&quot;Southern Cross University on LinkedIn&quot; title=&quot;Southern Cross University on LinkedIn&quot;&gt; LinkedIn&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scunews/index.php/31#youtube&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Connect-YouTube&#039;]);&quot;&gt;&lt;img src=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/SCU-template/img/share-sml/youtube-share-sml.png&quot; height=&quot;17&quot; width=&quot;17&quot; alt=&quot;Southern Cross University on YouTube&quot; title=&quot;Southern Cross University on YouTube&quot;&gt; YouTube&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/itunesu/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Connect-iTunesU&#039;]);&quot;&gt;&lt;img src=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/SCU-template/img/share-sml/itunesu-share-sml.png&quot; height=&quot;17&quot; width=&quot;17&quot; alt=&quot;Southern Cross University on iTunes&quot; title=&quot;Southern Cross University on iTunes&quot;&gt; iTunesU&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/enquiries/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;Connect-OnlineEnquiry&#039;]);&quot;&gt;Online enquiry&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;


&lt;/nav&gt; &lt;nav class=&quot;last&quot;&gt;
&lt;h4&gt;Commercial services&lt;/h4&gt;
&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/eal/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CommServ-EAL&#039;]);&quot;&gt;Environmental Analysis Laboratory&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://invercauldhouse.com.au/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CommServ-InvHouse&#039;]);&quot;&gt;Invercauld House&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://catering.scu.edu.au/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CommServ-SCUCater&#039;]);&quot;&gt;SCU Catering&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://gymandpool.scu.edu.au/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CommServ-SCUGymPool&#039;]);&quot;&gt;SCU Fitness for You&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/healthclinic/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CommServ-SCUHC&#039;]);&quot;&gt;SCU Health Clinic&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;http://unibarandcafe.scu.edu.au/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;CommServ-SCUUniBarCafe&#039;]);&quot;&gt;SCU Unibar and Cafe&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;h4&gt;Information about&lt;/h4&gt;
&lt;ul&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/space/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;InfA-CommEng&#039;]);&quot;&gt;Community Engagement&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/governance/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;InfA-Gover&#039;]);&quot;&gt;Governance&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/docs/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;InfA-PubPol&#039;]);&quot;&gt;Publications and Policies&lt;/a&gt;&lt;/li&gt;
&lt;li style=&quot;padding-bottom: 10px;&quot;&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/sustainability/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;InfA-Sust&#039;]);&quot;&gt;Sustainability&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;br&gt;
&lt;a id=&quot;RUN-link&quot; href=&quot;http://www.run.edu.au/&quot; target=&quot;_blank&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Nav&#039;, &#039;Click&#039;, &#039;RUNimg&#039;]);&quot;&gt;&lt;img title=&quot;Regional Universities Network&quot; src=&quot;//scu.edu.au/assets/res/i/scu/RUN_Logo.jpg&quot; alt=&quot;The Regional Universities Network (RUN) is a network of six universities with headquarters in regional Australia and a shared commitment to playing a transformative role in their regions.&quot;&gt;&lt;/a&gt;
&lt;/nav&gt;
&lt;/div&gt;
&lt;div class=&quot;footer-shadow&quot;&gt;&lt;/div&gt;
&lt;p class=&quot;top-link&quot;&gt;&lt;a href=&quot;#&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Links&#039;, &#039;Click&#039;, &#039;GF-Links-Top&#039;]);&quot;&gt;top&lt;/a&gt;&lt;/p&gt;
&lt;p class=&quot;global-footer&quot;&gt;
&lt;span class=&quot;SCU-copy-title&quot;&gt;&#169; &lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/&quot; title=&quot;Southern Cross University&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Links&#039;, &#039;Click&#039;, &#039;GF-Links-SCU&#039;]);&quot;&gt;Southern Cross University&lt;/a&gt;&lt;/span&gt;&lt;span class=&quot;sep titlesep&quot;&gt; | &lt;/span&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/wwwadmin/disclaimer/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Links&#039;, &#039;Click&#039;, &#039;GF-Links-Legals&#039;]);&quot;&gt;Legals&lt;/a&gt;&lt;span class=&quot;sep&quot;&gt; | &lt;/span&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/privacy/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Links&#039;, &#039;Click&#039;, &#039;GF-Links-Privacy&#039;]);&quot;&gt;Privacy&lt;/a&gt;&lt;span class=&quot;sep&quot;&gt; | &lt;/span&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/scunews/index.php/72/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Links&#039;, &#039;Click&#039;, &#039;GF-Links-Accessibility&#039;]);&quot;&gt;Accessibility&lt;/a&gt;&lt;span class=&quot;sep&quot;&gt; | &lt;/span&gt;&lt;a href=&quot;//</xsl:text><xsl:value-of select="$env"/><xsl:text disable-output-escaping="yes">.edu.au/contact/&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Links&#039;, &#039;Click&#039;, &#039;GF-Links-ContactUs&#039;]);&quot;&gt;Contact Us&lt;/a&gt;&lt;span class=&quot;admin-link&quot;&gt;&lt;span class=&quot;sep&quot;&gt; | &lt;/span&gt;&lt;a href=&quot;http://study.scu.edu.au/websys/content/index.php?site_id=50&amp;amp;action=Edit%20Item&amp;amp;page_id=31&quot; onclick=&quot;_gaq.push([&#039;_trackEvent&#039;, &#039;GF-Links&#039;, &#039;Click&#039;, &#039;GF-Links-SiteAdmin&#039;]);&quot;&gt;Site Admin&lt;/a&gt;&lt;/span&gt;&lt;span class=&quot;sep abnsep&quot;&gt; | &lt;/span&gt;&lt;span class=&quot;SCU-abn&quot;&gt;ABN: 41 995 651 524&lt;/span&gt;&lt;span class=&quot;sep cricosep&quot;&gt; | &lt;/span&gt;&lt;span class=&quot;SCU-cricos&quot;&gt;CRICOS Provider: 01241G&lt;/span&gt;
&lt;/p&gt;
&lt;/footer&gt;
    </xsl:text>
  <xsl:apply-templates select="TraceNode"/>
</xsl:template>
</xsl:stylesheet>



