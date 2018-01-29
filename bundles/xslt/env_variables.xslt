<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
	<xsl:variable name="env">%env_param%</xsl:variable>
	<!-- SCU template variables-->
	<xsl:variable name="global_scu_template_path">//<xsl:value-of select="$env"/>.edu.au/SCU-template</xsl:variable>
	<xsl:variable name="scu_template_css_path"><xsl:value-of select="$global_scu_template_path"/>/css</xsl:variable>
	<xsl:variable name="scu_template_js_path"><xsl:value-of select="$global_scu_template_path"/>/js</xsl:variable>
	<!-- CUSTOM GSA variables -->
	<xsl:variable name="custom_res_root_path">//<xsl:value-of select="$env"/>.edu.au/resources/gsa</xsl:variable>
	<xsl:variable name="custom_css_path"><xsl:value-of select="$custom_res_root_path"/>/css</xsl:variable>
	<xsl:variable name="custom_js_path"><xsl:value-of select="$custom_res_root_path"/>/js</xsl:variable>
	<xsl:variable name="custom_gfx_path"><xsl:value-of select="$custom_res_root_path"/>/gfx</xsl:variable>
</xsl:stylesheet>
