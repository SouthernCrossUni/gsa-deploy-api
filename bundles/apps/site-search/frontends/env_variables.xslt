<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
	<xsl:variable name="env">scu</xsl:variable>
	<xsl:variable name="gsa_env">scu</xsl:variable>
	<!-- DOMAIN LINKS -->
	<xsl:variable name="site_search_path">//site-search.<xsl:value-of select="$gsa_env"/>.edu.au</xsl:variable>
	<xsl:variable name="course_search_path">http://search.<xsl:value-of select="$env"/>.edu.au/courses</xsl:variable>
	<xsl:variable name="staff_intranet_path">//staff.<xsl:value-of select="$env"/>.edu.au</xsl:variable>
	<xsl:variable name="student_intranet_path">//study.<xsl:value-of select="$env"/>.edu.au</xsl:variable>
	<!-- SCU template variables-->
	<xsl:variable name="global_scu_resource_path">//<xsl:value-of select="$env"/>.edu.au/resources</xsl:variable>
	<xsl:variable name="global_scu_template_path">/SCU-template</xsl:variable>
	<xsl:variable name="scu_template_css_path"><xsl:value-of select="$global_scu_template_path"/>/css</xsl:variable>
	<xsl:variable name="scu_template_img_path"><xsl:value-of select="$global_scu_template_path"/>/img</xsl:variable>
	<xsl:variable name="scu_template_js_path"><xsl:value-of select="$global_scu_template_path"/>/js</xsl:variable>
	<xsl:variable name="scu_resource_js_path"><xsl:value-of select="$global_scu_resource_path"/>/js</xsl:variable>
	<xsl:variable name="scu_resource_css_path"><xsl:value-of select="$global_scu_resource_path"/>/css</xsl:variable>
	<!-- CUSTOM GSA variables -->
	<xsl:variable name="custom_res_root_path">//<xsl:value-of select="$env"/>.edu.au/resources/gsa</xsl:variable>
	<xsl:variable name="custom_css_path"><xsl:value-of select="$custom_res_root_path"/>/css</xsl:variable>
	<xsl:variable name="custom_js_path"><xsl:value-of select="$custom_res_root_path"/>/js</xsl:variable>
	<xsl:variable name="custom_gfx_path">//<xsl:value-of select="$env"/>.edu.au/resources/gfx/icons</xsl:variable>

	<!-- is the request skinless? -->
	<xsl:variable name="skin_class">
	<xsl:choose>
	  <xsl:when test="GSP/PARAM[@name='skin']">
	  	<xsl:value-of select="GSP/PARAM[@name='skin']/@value"></xsl:value-of>
	  </xsl:when>
	  <xsl:otherwise><!-- default to wrapper skin -->skinned</xsl:otherwise>
	</xsl:choose>
	</xsl:variable>
	<!-- LOCATION CODES -->
<xsl:variable name="global_location_cds">
  <locations>
   <location cd="U"><desc>Online</desc><class>U</class></location>
   <location cd="OL"><desc>SCU Online</desc><class>U</class></location>
   <location cd="L"><desc>Lismore</desc><class>onshore</class></location>
   <location cd="LBB"><desc>Lismore - BB</desc><class>onshore</class></location>
   <location cd="GCB"><desc>Gold Coast</desc><class>onshore</class></location>
   <location cd="CH"><desc>Coffs Harbour</desc><class>onshore</class></location>
   <location cd="MSC"><desc>National Marine Science Centre</desc><class>onshore</class></location>
   <location cd="SYD"><desc>Sydney</desc><class>onshore</class></location>
   <location cd="S"><desc>The Hotel School Sydney</desc><class>onshore</class></location>
   <location cd="MLB"><desc>Melbourne</desc><class>onshore</class></location>
   <location cd="MEL"><desc>The Hotel School Melbourne</desc><class>onshore</class></location>
   <location cd="PER"><desc>Perth</desc><class>onshore</class></location>
   <location cd="SP1"><desc>Singapore - MDIS</desc><class>offshore</class></location>
   <location cd="GX"><desc>China - Guangxi UST</desc><class>offshore</class></location>
   <location cd="TJ"><desc>China - TUST</desc><class>offshore</class></location>
   <location cd="HK"><desc>Hong Kong</desc><class>offshore</class></location>
   <location cd="TK1"><desc>Uzbekistan - MDIS Tashkent</desc><class>offshore</class></location>
   <location cd="PG1"><desc>Papua New Guinea - IBS Port Moresby</desc><class>offshore</class></location>
   <location cd="PG2"><desc>Papua New Guinea - IBS Enga</desc><class>offshore</class></location>
   <location cd="NZ"><desc>New Zealand - MIT</desc><class>offshore</class></location>
  </locations>
</xsl:variable>
</xsl:stylesheet>
