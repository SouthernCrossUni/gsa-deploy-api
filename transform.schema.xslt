<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:strip-space elements="*"/>
  <xsl:param name="appName" select="'site-search'"/>
  <xsl:param name="appId" select="/deployment/apps/app[@name=$appName]/@id"/>
  <!-- release seeds -->
  <xsl:param name="version"/>

  <xsl:template match="node()|@*">
      <xsl:copy>
        <xsl:apply-templates select="node()|@*"/>
      </xsl:copy>
      </xsl:template>
  <xsl:template match="deployment/child::node()">
      <xsl:copy-of select="./child::node()[@appRef = $appId]|./child::node()[not(@appRef) and not(contains(name(), 'app'))]"/>
      <xsl:apply-templates select="release"/>
  </xsl:template>

   <xsl:template match="app|comment()"/>
</xsl:stylesheet>
