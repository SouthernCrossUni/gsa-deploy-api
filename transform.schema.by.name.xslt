<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:param name="appName" select="'site-search'"/>
  <!-- release seeds -->
  <xsl:param name="build"/>
  <xsl:strip-space elements="*"/>

  <xsl:template match="node()|@*">
    <xsl:copy>
      <xsl:apply-templates select="node()|@*"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="deployment">
     <xsl:copy>
     <xsl:for-each select="./@*">
     <xsl:variable name="attrName"><xsl:value-of select="name()"/></xsl:variable>
     	<xsl:attribute name="{$attrName}">
     	<xsl:value-of select="." />
     	</xsl:attribute>
     </xsl:for-each>
		 <xsl:apply-templates select="node()[@appRef = $appName]|node()[not(@appRef)]">
		 <xsl:sort select="@sort"/>
		</xsl:apply-templates>
		<xsl:copy-of select="document('deploy.globals.xml')//globals/*"/>
      </xsl:copy>
  </xsl:template>
</xsl:stylesheet>
