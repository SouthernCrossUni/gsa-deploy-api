<?xml version="1.0" encoding="UTF-8"?>
<!-- *** Expert Search Stylesheet *** -->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
  <xsl:output method="html"/>
  <!--
    For checking the mode of this XSL's usage. Default is 0.
    1 - Enabled. Used during development.
    0 - Disabled. Used in production setup.
  -->
  <xsl:param name="test_mode" select="'0'" />

  <!-- *****************************************************************
                      Private variables and templates
                   PLEASE DO NOT ACCESS OUTSIDE THIS XSL

       See "Public variables and templates" section below to know what
       can be accessed outside this XSL.
       *****************************************************************  -->

  <!--
    Query param flag to detect  if current query is an expert search query.
    'true' - expert search query.
    'false' - not an expert search query.
    @private
  -->
  <xsl:variable name="is_expert_search_query_"
      select="/GSP/PARAM[@name='expertsearch']/@value" />

  <!--
    Query param flag to detect if the expert search is being accessed in
    expanded mode.
    'true' - is in expanded mode.
    @private
  -->
  <xsl:variable name="is_expanded_mode_"
      select="/GSP/PARAM[@name='expertsearchexpand']/@value" />

  <!--
    Current stylesheet in effect i.e. 'proxystylesheet='  param.
    @private
  -->
  <xsl:variable name="current_proxystylesheet_"
      select="/GSP/PARAM[@name='proxystylesheet']/@value" />

  <!--
    Number of results allowed per page. By default, it's 10. Incoming 'num'
    parameter can override the value to the desired number.
    @private
  -->
  <xsl:variable name="expert_results_per_page_">
    <xsl:choose>
      <xsl:when test="/GSP/PARAM[(@name='num') and (@value!='')]">
        <xsl:value-of select="/GSP/PARAM[@name='num']/@value"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:value-of select="10"/>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:variable>

  <!--
    Current search query term in unescaped form.
    @private
  -->
  <xsl:variable name="current_query_unescaped_" select="/GSP/Q" />

  <!--
    Current search query term i.e. 'q=' param.
    @private
  -->
  <xsl:variable name="current_query_"
      select="encode-for-uri($current_query_unescaped_)" />

  <!--
    Original search query term i.e. 'q=' param used before navigating to the
    expanded mode. Used when returning back from the expanded mode to main
    results mode.
    @private
  -->
  <xsl:variable name="original_query_"
      select="/GSP/PARAM[@name='originalquery']/@original_value" />

  <!--
    Expert search stylesheet that initiated the expanded mode. This is used to
    go back to the original widget view results page from the expanded mode.
    @private
  -->
  <xsl:variable name="expert_search_proxystylesheet_"
      select="/GSP/PARAM[@name='expertsearchfrontend']/@value" />

  <!--
    The 'client=' query param that should be used to select frontend settings.
    This should be the value of 'proxystylesheet=' param because the expert
    search view is made accessible via the proxystylesheet. The expert search
    backend will read client= param to figure out the expert search config to
    use.
    @private
  -->
  <xsl:variable name="client_frontend_to_use_"
      select="$current_proxystylesheet_" />

  <!--
    Current collection in effect i.e. 'site=' query param.
    @private
  -->
  <xsl:variable name="current_collection_"
      select="/GSP/PARAM[@name='site']/@value" />

  <!--
    If the user is accessing the results page with JavaScript not enabled.
    'true' - if JavaScript is disabled.
    @private
  -->
  <xsl:variable name="noscript_mode_"
      select="/GSP/PARAM[@name='noscript_mode']/@value" />

  <!--
    The frontend used to present the expanded mode for the expert results.
    @private
  -->
  <xsl:variable name="expert_search_expand_mode_frontend_"
      select="/GSP/ExpertSearchConfig/ExpandedView/FrontendName" />

  <!--
    The text to be shown for detailed view link.
    @private
  -->
  <xsl:variable name="expert_search_detailed_view_text_"
      select="/GSP/ExpertSearchConfig/View/WidgetDetailedText" />

  <!--
    The text to be shown for widget header.
    @private
  -->
  <xsl:variable name="expert_search_heading_title_"
      select="/GSP/ExpertSearchConfig/View/WidgetHeaderText" />

  <!--
    Number of results that should be displayed per page in the widget view.
    @private
  -->
  <xsl:variable name="num_res_widget_view_"
      select="/GSP/ExpertSearchConfig/View/NumResultsToDisplayInWidget" />

  <!--
    Number of results that should be displayed per page in the expanded view.
    @private
  -->
  <xsl:variable name="num_res_expanded_view_"
      select="/GSP/ExpertSearchConfig/View/NumResultsToDisplayInExpandedMode" />

  <!--
    Query param flag to detect if the expert search is being accessed in
    asynchronous JavaScript mode.
    @private
  -->
  <xsl:variable name="is_expert_async_search_"
      select="/GSP/PARAM[@name='expertsearchasync']/@value"/>

  <!--
    Query param flag to detect if the expert search is secure search mode.
    @private
  -->
  <xsl:variable name="access_"
      select="/GSP/PARAM[@name='access']/@value"/>

  <!--
    Finds the given string and replaces the same with the specified string.

    Params:
      find: The string that should be searched.
      replace: The string that should be substituted.
      source: The source string on which search / replace should happen.
    Returns:
      The modified string with the requested substring replaced.
    @private
  -->
  <xsl:template name="find_and_replace_string_">
    <xsl:param name="find" />
    <xsl:param name="replace" />
    <xsl:param name="source" />
    <xsl:value-of select="replace($source, $find, $replace)" />
  </xsl:template>

  <!--
    Composes the query string used for fetching the expert search results.

    Params:
      src_prefix: The prefix that should be added to the query string.
      extra_args: Any extra query string arguments that should be added apart
          from the common arguments.
    Returns:
      A string containing the composed query string.
    @private
  -->
  <xsl:template name="compose_expert_search_query_string_">
    <xsl:param name="src_prefix" select="''" />
    <xsl:param name="extra_args" select="''" />
    <xsl:value-of select="$src_prefix" />
    <xsl:value-of select="$extra_args" />
    <xsl:if test="$extra_args">
      <xsl:text disable-output-escaping="yes">&amp;</xsl:text>
    </xsl:if>
    <xsl:text disable-output-escaping="yes">q=</xsl:text>
    <xsl:value-of select="$current_query_" />
    <xsl:text
        disable-output-escaping="yes">&amp;expertsearch=true</xsl:text>
    <xsl:text
        disable-output-escaping="yes">&amp;proxystylesheet=</xsl:text>
    <xsl:value-of select="$current_proxystylesheet_" />
    <xsl:text
        disable-output-escaping="yes">&amp;client=</xsl:text>
    <xsl:value-of select="$client_frontend_to_use_" />
    <xsl:text
        disable-output-escaping="yes">&amp;site=</xsl:text>
    <xsl:value-of select="$current_collection_" />
    <xsl:text
        disable-output-escaping="yes">&amp;filter=0</xsl:text>
    <xsl:text
        disable-output-escaping="yes">&amp;getfields=*</xsl:text>
    <xsl:text
        disable-output-escaping="yes">&amp;num=</xsl:text>
    <xsl:value-of select="$num_res_widget_view_" />
    <xsl:text
        disable-output-escaping="yes">&amp;access=</xsl:text>
    <xsl:value-of select="$access_" />
  </xsl:template>

  <!--
    Renders expert search results using iframe in noscript mode i.e. when
    JavaScript is not enabled.

    Params:
      src_prefix: The prefix that should be added to the src URL string for the
          iframe.
    Returns:
      An iframe embedded inside noscript tag to render expert results.
    @private
  -->
  <xsl:template name="render_expert_search_results_in_noscript_mode_">
    <xsl:param name="src_prefix" select="'?'" />
    <noscript>
      <iframe width="100%" frameborder="0" height="380px;">
        <xsl:attribute name="src">
          <xsl:call-template name="compose_expert_search_query_string_">
            <xsl:with-param name="src_prefix" select="$src_prefix" />
            <xsl:with-param name="extra_args">
              <xsl:text>noscript_mode=true</xsl:text>
            </xsl:with-param>
          </xsl:call-template>
        </xsl:attribute>
      </iframe>
    </noscript>
  </xsl:template>

  <!--
    Generates link tag for pagination element for the pagination section.

    Params:
      is_link: '1' if the tag should be a hyperlink; '0' for plain text span
          tag.
      title: The title to be associated with the tag.
      display_text: The text to be displayed within link or plain text
          container.
      start_index: The starting index to be used to start query string argument.
      href_prefix: The prefix to be used in the href attribute if it's a link.
    Returns:
      The HTML markup containing list items for page numbers.
    @private
  -->
  <xsl:template name="generate_paginate_tag_">
    <xsl:param name="is_link" />
    <xsl:param name="title"/>
    <xsl:param name="display_text"/>
    <xsl:param name="start_index" />
    <xsl:param name="href_prefix" />
    <li>
      <xsl:choose>
        <xsl:when test="$is_link = '1'">
          <a>
            <xsl:attribute name="href">
              <xsl:value-of select="$href_prefix" />
              <xsl:text>&amp;start=</xsl:text>
              <xsl:value-of select="$start_index" />
            </xsl:attribute>
            <xsl:attribute name="title">
              <xsl:value-of select="$title" />
            </xsl:attribute>
            <xsl:value-of select="$display_text" />
          </a>
        </xsl:when>
        <xsl:otherwise>
          <span>
            <xsl:attribute name="title">
              <xsl:value-of select="$title" />
            </xsl:attribute>
            <xsl:value-of select="$display_text" />
          </span>
        </xsl:otherwise>
      </xsl:choose>
    </li>
  </xsl:template>

  <!--
    Generates the page numbers in the pagination section.

    Params:
      msg_*: All localized message strings. See the params documentation of
          "render_expert_search_results" template in this file for details.
      start: The starting index of the result page.
      end: The index of the last result element.
      current_results_first_index: The index of the first result for the current
          page to be displayed. 1-based starting index is assumed.
    Returns:
      The HTML markup containing list items for page numbers.
    @private
  -->
  <xsl:template name="generate_pagination_numbers_">
    <xsl:param name="msg_results_page_number_prefix" />
    <xsl:param name="href_prefix" />
    <xsl:param name="start" select="'0'"/>
    <xsl:param name="end"/>
    <xsl:param name="current_results_first_index"/>
    <xsl:variable name="page_number"
        select="($start div $expert_results_per_page_) + 1"/>
    <xsl:choose>
      <xsl:when test="
          $start &lt;
          ($current_results_first_index - (10 * $expert_results_per_page_))">
      </xsl:when>
      <xsl:when test="($current_results_first_index &gt;= $start) and
          ($current_results_first_index &lt;
              ($start + $expert_results_per_page_))">
        <xsl:call-template name="generate_paginate_tag_">
          <xsl:with-param name="is_link" select="'0'" />
          <xsl:with-param name="title">
            <xsl:value-of select="$msg_results_page_number_prefix"/>
            <xsl:text> </xsl:text>
            <xsl:value-of select="$page_number" />
          </xsl:with-param>
          <xsl:with-param name="display_text" select="$page_number" />
        </xsl:call-template>
      </xsl:when>
      <xsl:otherwise>
        <xsl:call-template name="generate_paginate_tag_">
          <xsl:with-param name="is_link" select="'1'" />
          <xsl:with-param name="title">
            <xsl:value-of select="$msg_results_page_number_prefix"/>
            <xsl:text> </xsl:text>
            <xsl:value-of select="$page_number" />
          </xsl:with-param>
          <xsl:with-param name="display_text" select="$page_number" />
          <xsl:with-param name="start_index" select="$start" />
          <xsl:with-param name="href_prefix" select="$href_prefix" />
        </xsl:call-template>
      </xsl:otherwise>
    </xsl:choose>
    <!-- Recursively iterate to display all page numbers, as required. -->
    <xsl:if test="(($start + $expert_results_per_page_) &lt; $end) and
        (($start + $expert_results_per_page_) &lt;
            ($current_results_first_index + (10 * $expert_results_per_page_)))">
      <xsl:call-template name="generate_pagination_numbers_">
        <xsl:with-param name="msg_results_page_number_prefix"
            select="$msg_results_page_number_prefix" />
        <xsl:with-param name="href_prefix" select="$href_prefix" />
        <xsl:with-param name="start"
            select="$start + $expert_results_per_page_" />
        <xsl:with-param name="end" select="$end" />
        <xsl:with-param name="current_results_first_index"
            select="$current_results_first_index" />
      </xsl:call-template>
    </xsl:if>
  </xsl:template>

  <!--
    Generates pagination section for the current results.

    Params:
      msg_*: All localized message strings. See the params documentation of
          "render_expert_search_results" template in this file for details.
      prev_link: A string containing the previous link, if available.
      next_link: A string containing the next link, if available.
      current_results_first_index: The index of the first result for the current
          page to be displayed. 1-based starting index is assumed.
      current_results_last_index: The index of the last result for the current
          page to be displayed. 1-based starting index is assumed.
      estimated_total_results: The estimated number of total results, if
          available.
    Returns:
      The initial source string with all placeholders substituted with values.
    @private
  -->
  <xsl:template name="generate_pagination_">
    <xsl:param name="msg_results_page_number_prefix" />
    <xsl:param name="msg_go_to_previous_page" />
    <xsl:param name="msg_go_to_next_page" />
    <xsl:param name="msg_previous_page_action" />
    <xsl:param name="msg_next_page_action" />
    <xsl:param name="href_prefix" />
    <xsl:param name="prev_link" />
    <xsl:param name="next_link" />
    <xsl:param name="current_results_first_index" />
    <xsl:param name="current_results_last_index" />
    <xsl:param name="estimated_total_results" />

    <!-- Check if pagination should displayed or not. -->
    <xsl:if test="$prev_link or $next_link">
      <ol class="gsa-exp-pagination">
      <!-- Show previous link, if available. -->
      <xsl:if test="$prev_link">
        <xsl:call-template name="generate_paginate_tag_">
          <xsl:with-param name="is_link" select="'1'" />
          <xsl:with-param name="title" select="$msg_go_to_previous_page" />
          <xsl:with-param name="display_text"
              select="$msg_previous_page_action" />
          <xsl:with-param name="start_index"
              select="$current_results_first_index -
                  $expert_results_per_page_ - 1" />
          <xsl:with-param name="href_prefix" select="$href_prefix" />
        </xsl:call-template>
      </xsl:if>

      <!-- Google result set navigation. -->
      <xsl:variable name="results_end_index">
        <xsl:choose>
          <xsl:when test="$next_link">
            <xsl:value-of select="$estimated_total_results" />
          </xsl:when>
          <xsl:otherwise>
            <xsl:value-of select="$current_results_last_index" />
          </xsl:otherwise>
        </xsl:choose>
      </xsl:variable>

      <!-- Generate page numbers in between, if estimated results number is
           available. -->
      <xsl:if test="$estimated_total_results != ''">
        <xsl:call-template name="generate_pagination_numbers_">
          <xsl:with-param name="msg_results_page_number_prefix"
              select="$msg_results_page_number_prefix" />
          <xsl:with-param name="href_prefix" select="$href_prefix" />
          <xsl:with-param name="start" select="0" />
          <xsl:with-param name="end" select="$results_end_index" />
          <xsl:with-param name="current_results_first_index"
              select="($current_results_first_index) - 1" />
        </xsl:call-template>
      </xsl:if>

      <!-- Show next link, if available. -->
      <xsl:if test="$next_link">
        <xsl:call-template name="generate_paginate_tag_">
          <xsl:with-param name="is_link" select="'1'" />
          <xsl:with-param name="title" select="$msg_go_to_next_page" />
          <xsl:with-param name="display_text" select="$msg_next_page_action" />
          <xsl:with-param name="start_index"
              select="$current_results_first_index +
                  $expert_results_per_page_ - 1" />
          <xsl:with-param name="href_prefix" select="$href_prefix" />
        </xsl:call-template>
      </xsl:if>
      </ol>
    </xsl:if>
  </xsl:template>

  <!--
    Substitutes value in the opening/closing curly {<METADATA_NAME>}
    placeholder(s) of the source string by fetching the same from the specified
    result XML sub-tree.

    Params:
      source_string: The source string containing the placeholder(s) in
          {<METADATA_NAME>} format.
      current_result: The result XML sub-tree that contains value for the
          placeholder(s).
    Returns:
      The initial source string with all placeholders substituted with values.
    @private
  -->
  <xsl:template name="substitute_value_in_placeholder_">
    <xsl:param name="source_string" />
    <xsl:param name="current_result" />
    <xsl:variable name="before_opening"
        select="substring-before($source_string, '{')" />
    <xsl:variable name="after_opening"
        select="substring-after($source_string, '{')" />
    <xsl:variable name="after_closing"
        select="substring-after($source_string, '}')" />
    <xsl:variable name="attribute_to_lookup"
        select="substring-before($after_opening, '}')" />
    <xsl:choose>
      <xsl:when test="$attribute_to_lookup = ''">
        <xsl:value-of select="$source_string" />
      </xsl:when>
      <xsl:otherwise>
        <xsl:variable name="attribute_value"
            select="$current_result/MT[@N=$attribute_to_lookup]/@V" />
        <xsl:variable name="new_source_string"
          select="concat(
              $before_opening, string-join($attribute_value, ', '), $after_closing)" />
        <xsl:call-template name="substitute_value_in_placeholder_">
          <xsl:with-param name="source_string" select="$new_source_string" />
          <xsl:with-param name="current_result" select="$current_result" />
        </xsl:call-template>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!--
    Generates the content markup for the specified field element in the config.

    Params:
      current_field: The current field element that should be processed to
          generate appropriate markup.
      source_string: The source string containing the placeholder(s) in
          {METADATA_NAME} format.
      current_result: The result XML sub-tree that contains value for the
          placeholder(s).
    Returns:
      The HTML markup for the specified field element. As of now, this can be
      image or text content with optional label and wrapped around with optional
      anchor element (if it's a link).
    @private
  -->
  <xsl:template name="generate_content_markup_">
    <xsl:param name="current_field" />
    <xsl:param name="source_string" />
    <xsl:param name="current_result" />

    <!-- Display label if required. -->
    <xsl:if test="$current_field/Label != ''">
      <span class="gsa-exp-label">
        <xsl:value-of select="$current_field/Label" />:
      </span>
    </xsl:if>

    <!-- Get the value substituted landing URL, if the field is a link. -->
    <xsl:variable name="landing_url">
      <xsl:if test="$current_field/LandingUrl">
        <xsl:call-template name="substitute_value_in_placeholder_">
          <xsl:with-param name="source_string"
              select="$current_field/LandingUrl" />
          <xsl:with-param name="current_result" select="$current_result" />
        </xsl:call-template>
      </xsl:if>
    </xsl:variable>

    <!-- Wrap with anchor tag if field is a link. -->
    <xsl:if test="$landing_url != ''">
      <xsl:text disable-output-escaping="yes">&lt;a href="</xsl:text>
      <xsl:value-of select="$landing_url" />
      <xsl:text>"</xsl:text>
      <xsl:if test="$current_field/Description and
          $current_field/Type != 'image'">
        <xsl:text disable-output-escaping="yes"> title="</xsl:text>
        <xsl:call-template name="substitute_value_in_placeholder_">
            <xsl:with-param name="source_string"
                select="$current_field/Description" />
            <xsl:with-param name="current_result"
                select="$current_result" />
        </xsl:call-template>
        <xsl:text>"</xsl:text>
      </xsl:if>
      <xsl:text disable-output-escaping="yes">></xsl:text>
    </xsl:if>

    <xsl:choose>
      <xsl:when test="$current_field/Type = 'image'">
        <!-- Set image attributes based on specified config. -->
        <img>
          <xsl:attribute name="src">
            <xsl:call-template name="substitute_value_in_placeholder_">
              <xsl:with-param name="source_string"
                  select="$current_field/Value" />
              <xsl:with-param name="current_result"
                  select="$current_result" />
            </xsl:call-template>
          </xsl:attribute>
          <xsl:if test="$current_field/Description">
            <xsl:attribute name="alt">
              <xsl:call-template name="substitute_value_in_placeholder_">
                <xsl:with-param name="source_string"
                    select="$current_field/Description" />
                <xsl:with-param name="current_result"
                    select="$current_result" />
              </xsl:call-template>
            </xsl:attribute>
          </xsl:if>
          <xsl:if test="$current_field/Description">
            <xsl:attribute name="title">
              <xsl:call-template name="substitute_value_in_placeholder_">
                <xsl:with-param name="source_string"
                    select="$current_field/Description" />
                <xsl:with-param name="current_result"
                    select="$current_result" />
              </xsl:call-template>
            </xsl:attribute>
          </xsl:if>
          <xsl:if test="$current_field/Width">
            <xsl:attribute name="width">
              <xsl:value-of select="$current_field/Width" />
            </xsl:attribute>
          </xsl:if>
          <xsl:if test="$current_field/Height">
            <xsl:attribute name="height">
              <xsl:value-of select="$current_field/Height" />
            </xsl:attribute>
          </xsl:if>
        </img>
      </xsl:when>
      <xsl:when test="$current_field/Type = 'text'">
        <span>
        <xsl:call-template name="substitute_value_in_placeholder_">
          <xsl:with-param name="source_string" select="$current_field/Value" />
          <xsl:with-param name="current_result" select="$current_result" />
        </xsl:call-template>
        </span>
      </xsl:when>
    </xsl:choose>

    <xsl:if test="$landing_url != ''">
      <xsl:text disable-output-escaping="yes">&lt;/a>
      </xsl:text>
    </xsl:if>
  </xsl:template>

  <!--
    Processes the specified result element containing expert information.

    Params:
      current_result: The result XML sub-tree that contains the expert
          information.
    Returns:
      The HTML markup representing a single expert information in the overall
      expert results list.
    @private
  -->
  <xsl:template name="process_expert_result_">
    <xsl:param name="current_result" />
    <!-- Determine the view mode to select the fields to be rendered. -->
    <xsl:variable name="view_type">
      <xsl:choose>
        <xsl:when test="$is_expanded_mode_ = 'true'">
          <xsl:text>detailed</xsl:text>
        </xsl:when>
        <xsl:otherwise>
          <xsl:text>widget</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <div class="g-section">
      <div class="gsa-exp-result-container">
        <table cellpadding="0" cellspacing="0">
          <tr>
          <xsl:for-each select="/GSP/ExpertSearchConfig/View/Row/Column">
            <xsl:choose>
              <xsl:when test="Field" >
                <td>
                <xsl:for-each select="Field">
                  <xsl:if test="current()/RenderMode = $view_type or
                      current()/RenderMode = 'both'">
                    <div class="gsa-exp-img-container">
                      <xsl:call-template name="generate_content_markup_">
                        <xsl:with-param name="current_field"
                            select="current()" />
                        <xsl:with-param name="source_string"
                            select="current()/Value" />
                        <xsl:with-param name="current_result"
                            select="$current_result" />
                      </xsl:call-template>
                    </div>
                  </xsl:if>
                </xsl:for-each>
                </td>
              </xsl:when>
              <xsl:otherwise>
                <td>
                <div class="gsa-exp-info-container">
                  <xsl:for-each select="current()/Row">
                    <div>
                      <!--
                        Add row specific class for customizing style for a
                        specific info row in the UI. Useful for external
                        customization.
                      -->
                      <xsl:variable name="row_position" select="position()" />
                      <xsl:attribute name="class">
                        <xsl:text>gsa-exp-info-row gsa-exp-info-row-</xsl:text>
                        <xsl:value-of select="$row_position" />
                      </xsl:attribute>
                      <xsl:for-each select="current()/Column">
                        <xsl:if test="
                            Field/RenderMode=$view_type or
                            Field/RenderMode='both'">
                          <div>
                            <!--
                              Add coloumn specific class for customizing style
                              for a specific row-rolumn in the UI. Useful for
                              external customization.
                            -->
                            <xsl:attribute name="class">
                              <xsl:text>gsa-exp-info-column-ele </xsl:text>
                              <xsl:text>gsa-exp-info-row-</xsl:text>
                              <xsl:value-of select="$row_position" />
                              <xsl:text>-col-</xsl:text>
                              <xsl:value-of select="position()" />
                            </xsl:attribute>
                            <xsl:call-template name="generate_content_markup_">
                              <xsl:with-param name="current_field"
                                  select="Field" />
                              <xsl:with-param name="source_string"
                                  select="Field/Value" />
                              <xsl:with-param name="current_result"
                                  select="$current_result" />
                            </xsl:call-template>
                          </div>
                        </xsl:if>
                      </xsl:for-each>
                    </div>
                  </xsl:for-each>
                </div>
                </td>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:for-each>
          </tr>
        </table>
      </div>
    </div>
  </xsl:template>

  <!--
    Renders the HTML markup for the expanded mode, as required.

    Params:
      href_prefix: The prefix that should be added to the query string.
      current_search_query_args: The current query string extracted from the
          absolute incoming search request params.
      msg_*: All localized message strings. See the params documentation of
          "render_expert_search_results" template in this file for details.
    Returns:
      The HTML markup containing expand link.
    @private
  -->
  <xsl:template name="render_expand_link_">
    <xsl:param name="href_prefix" select="'?'" />
    <xsl:param name="current_search_query_args" select="''" />
    <xsl:param name="msg_expert_search_switch_to_expanded_mode" />
    <!-- Display expand link if expanded mode is configured. -->
    <xsl:if test="count(/GSP/RES/R) > 0 and not($is_expanded_mode_) and
        $expert_search_expand_mode_frontend_ != ''">
      <xsl:variable name="expand_href_prefix">
        <xsl:call-template name="find_and_replace_string_">
          <xsl:with-param name="find">
            <xsl:text>proxystylesheet=</xsl:text>
            <xsl:value-of select="$current_proxystylesheet_" />
          </xsl:with-param>
          <xsl:with-param name="replace">
            <xsl:text>proxystylesheet=</xsl:text>
            <xsl:value-of select="$expert_search_expand_mode_frontend_" />
          </xsl:with-param>
          <xsl:with-param name="source" select="$current_search_query_args" />
        </xsl:call-template>
      </xsl:variable>
      <xsl:variable name="existing_num_res"
          select="/GSP/PARAM[@name='num']/@value" />
      <xsl:variable name="expand_href_prefix_2">
        <xsl:choose>
          <xsl:when test="not($existing_num_res)">
            <xsl:value-of select="$expand_href_prefix" />
            <xsl:text disable-output-escaping="yes">&amp;num=</xsl:text>
            <xsl:value-of select="$num_res_expanded_view_" />
          </xsl:when>
          <xsl:otherwise>
            <xsl:call-template name="find_and_replace_string_">
              <xsl:with-param name="find">
                <xsl:text>num=</xsl:text>
                <xsl:value-of select="$existing_num_res" />
              </xsl:with-param>
              <xsl:with-param name="replace">
                <xsl:text>num=</xsl:text>
                <xsl:value-of select="$num_res_expanded_view_" />
              </xsl:with-param>
              <xsl:with-param name="source" select="$expand_href_prefix" />
            </xsl:call-template>
          </xsl:otherwise>
        </xsl:choose>
      </xsl:variable>
      <xsl:variable name="expand_href_prefix_3">
        <xsl:call-template name="find_and_replace_string_">
          <xsl:with-param name="find">
            <xsl:text>client=</xsl:text>
            <xsl:value-of select="$client_frontend_to_use_" />
          </xsl:with-param>
          <xsl:with-param name="replace">
            <xsl:text>client=</xsl:text>
            <xsl:value-of select="$expert_search_expand_mode_frontend_" />
          </xsl:with-param>
          <xsl:with-param name="source" select="$expand_href_prefix_2" />
        </xsl:call-template>
      </xsl:variable>
      <a class="gsa-exp-expand-link">
        <xsl:attribute name="href">
          <xsl:value-of select="$href_prefix" />
          <xsl:value-of select="$expand_href_prefix_3" />
          <xsl:text
            disable-output-escaping="yes">&amp;expertsearchexpand=</xsl:text>
          <xsl:text>true</xsl:text>
          <xsl:text
            disable-output-escaping="yes">&amp;expertsearchfrontend=</xsl:text>
          <xsl:value-of select="$current_proxystylesheet_" />
          <xsl:text
            disable-output-escaping="yes">&amp;originalquery=</xsl:text>
          <xsl:value-of select="$current_query_" />
        </xsl:attribute>
        <xsl:attribute name="title">
          <xsl:value-of select="$msg_expert_search_switch_to_expanded_mode" />
        </xsl:attribute>
        <xsl:attribute name="target">
          <xsl:choose>
            <xsl:when test="$noscript_mode_ = 'true'">
              <xsl:text>_parent</xsl:text>
            </xsl:when>
            <xsl:otherwise>
              <xsl:text>_self</xsl:text>
            </xsl:otherwise>
          </xsl:choose>
        </xsl:attribute>
        <xsl:text>[</xsl:text>
        <xsl:value-of select="$expert_search_detailed_view_text_" />
        <xsl:text>]</xsl:text>
      </a>
    </xsl:if>
  </xsl:template>

  <!--
    Renders the HTML markup for the expert search results section.

    Params:
      href_prefix: The prefix that should be added to the query string.
      current_search_query_args: The current query string extracted from the
          absolute incoming search request params.
      msg_*: All localized message strings. See the params documentation of
          "render_expert_search_results" template in this file for details.
    Returns:
      The HTML markup containing expert results section.
    @private
  -->
  <xsl:template name="render_expert_search_results_">
    <xsl:param name="href_prefix" select="'?'" />
    <xsl:param name="current_search_query_args" select="''" />
    <xsl:param name="msg_expert_search_no_experts_found" />
    <xsl:param name="msg_expert_search_switch_to_expanded_mode" />
    <xsl:param name="msg_results_page_number_prefix" />
    <xsl:param name="msg_go_to_previous_page" />
    <xsl:param name="msg_go_to_next_page" />
    <xsl:param name="msg_previous_page_action" />
    <xsl:param name="msg_next_page_action" />
    <xsl:if test="$is_expert_search_configured = '1'">
      <div class="g-section gsa-exp-container">
        <div class="gsa-exp-header">
          <div class="g-section">
            <div>
              <xsl:if test="not($is_expanded_mode_)">
              <h2>
                <xsl:value-of select="$expert_search_heading_title_" />
              </h2>
              </xsl:if>
              <xsl:call-template name="render_expand_link_">
                <xsl:with-param name="href_prefix" select="$href_prefix" />
                <xsl:with-param name="current_search_query_args"
                    select="$current_search_query_args" />
                <xsl:with-param name="msg_expert_search_switch_to_expanded_mode"
                    select="$msg_expert_search_switch_to_expanded_mode" />
              </xsl:call-template>
            </div>
          </div>
        </div>
        <!-- Display appropriate view based on presence/absence of results. -->
        <xsl:choose>
          <xsl:when test="count(/GSP/RES/R) > 0">
            <ol class="gsa-exp-results">
              <xsl:for-each select="/GSP/RES/R">
               <li tabindex="0">
                <xsl:call-template name="process_expert_result_">
                  <xsl:with-param name="current_result" select="current()" />
                </xsl:call-template>
              </li>
              </xsl:for-each>
            </ol>
            <!--
              Don't display pagination in expanded mode as we piggyback on
              existing organic results pagination.
            -->
            <xsl:if test="not($is_expanded_mode_)">
              <xsl:call-template name="generate_pagination_">
                <xsl:with-param name="msg_results_page_number_prefix"
                    select="$msg_results_page_number_prefix" />
                <xsl:with-param name="msg_go_to_previous_page"
                    select="$msg_go_to_previous_page" />
                <xsl:with-param name="msg_go_to_next_page"
                    select="$msg_go_to_next_page" />
                <xsl:with-param name="msg_previous_page_action"
                    select="$msg_previous_page_action" />
                <xsl:with-param name="msg_next_page_action"
                    select="$msg_next_page_action" />
                <xsl:with-param name="href_prefix" >
                  <xsl:call-template name="compose_expert_search_query_string_">
                    <xsl:with-param name="src_prefix" select="$href_prefix" />
                  </xsl:call-template>
                </xsl:with-param>
                <xsl:with-param name="prev_link" select="/GSP/RES/NB/PU" />
                <xsl:with-param name="next_link" select="/GSP/RES/NB/NU" />
                <xsl:with-param name="current_results_first_index"
                    select="/GSP/RES/@SN" />
                <xsl:with-param name="current_results_last_index"
                    select="/GSP/RES/@EN" />
                <xsl:with-param name="estimated_total_results"
                    select="/GSP/RES/M" />
              </xsl:call-template>
            </xsl:if>
          </xsl:when>
          <xsl:otherwise>
            <span class="gsa-exp-no-results">
              <xsl:value-of select="$msg_expert_search_no_experts_found" />
            </span>
          </xsl:otherwise>
        </xsl:choose>
      </div>
    </xsl:if>
  </xsl:template>

  <!-- *********** END OF PRIVATE VARIABLES AND TEMPLATES  *************  -->

  <!-- *****************************************************************
                      Public variables and templates
                     CAN BE ACCESSED OUTSIDE THIS XSL
       *****************************************************************  -->

  <!--
    Checks if expert search is configured or not.
    1 - configured.
    0 - not configured.
   -->
  <xsl:variable name="is_expert_search_configured">
    <xsl:if test="/GSP/ExpertSearchConfig">1</xsl:if>
  </xsl:variable>

  <!--
    Checks if expert search widget view should be displayed or not in current
    context.
    1 - should be displayed.
    0 - should not be displayed.
   -->
  <xsl:variable name="show_expert_search_widget_view">
    <xsl:if test="$is_expert_search_configured = '1' and
                  not($is_expanded_mode_)">1</xsl:if>
  </xsl:variable>

  <!--
    Checks if expert search widget view results should be displayed or not.
    1 - should be displayed.
    0 - should not be displayed.
   -->
  <xsl:variable name="show_expert_search_widget_view_results">
    <xsl:if test="$is_expert_search_configured = '1' and
        $is_expert_search_query_ = 'true' and
        not($is_expanded_mode_)">1</xsl:if>
  </xsl:variable>

  <!--
    Checks if expert search results should be displayed or not in expanded mode.
    1 - should be displayed.
    0 - should not be displayed.
   -->
  <xsl:variable name="show_expert_search_expanded_results">
    <xsl:if test="$is_expert_search_configured = '1' and
        $is_expert_search_query_ = 'true' and
        $expert_search_expand_mode_frontend_ = $current_proxystylesheet_ and
        $is_expanded_mode_ = 'true'">1</xsl:if>
  </xsl:variable>

  <!--
    Includes the CSS file containing expert search styles.

    Params:
      doc_dir: The directionality of the document i.e. LTR or RTL.
      src_prefix: The prefix that should be added to the CSS source URI.
    Returns:
      The link tag including the appropriate CSS file based on the document
      directionality.
  -->
  <xsl:template name="include_expert_search_css">
    <xsl:param name="doc_dir" select="'ltr'" />
    <xsl:param name="src_prefix" select="'//static-gsa.s3-website-ap-southeast-2.amazonaws.com'" />
    <xsl:if test="$is_expert_search_configured = '1'">
      <xsl:choose>
        <xsl:when test="$doc_dir = 'rtl'">
          <link rel="stylesheet"
              href="{$src_prefix}/expertsearchdesktop_rtl.css"
              type="text/css" />
        </xsl:when>
        <xsl:otherwise>
          <link rel="stylesheet" href="//static-gsa.s3-website-ap-southeast-2.amazonaws.com/expertsearchdesktop.css"
              type="text/css" />
        </xsl:otherwise>
      </xsl:choose>
    </xsl:if>
  </xsl:template>

  <!--
    Includes the JavaScript file containing expert search component for enhanced
    functionality when JavaScript is enabled in user's browser.

    Params:
      src_prefix: The prefix that should be added to the JS source URI.
    Returns:
      The script tag including the JavaScript file.
  -->
  <xsl:template name="include_expert_search_js">
    <xsl:param name="src_prefix" select="''" />
    <!--  Include only for widget view -->
    <xsl:if test="$show_expert_search_widget_view = '1'">
      <script src="{$src_prefix}/expertsearchdesktop_compiled.js"
          type="text/javascript">
      </script>
    </xsl:if>
  </xsl:template>

  <!--
    Includes the JavaScript block for initializing the expert search JavaScript
    component for enhanced behavior when JavaScript is enabled in user's
    browser.

    Note: this should only be called after the JavaSript file has been
    included via "include_expert_search_js" template call.

    Params:
      dom_container: The DOM element that should hold the expert search section.
      script_import: '1' if initialization code should be called via an explicit
          <script> import.
    Returns:
      The script block with the initializing logic.
  -->
  <xsl:template name="include_expert_search_js_init">
    <xsl:param name="dom_container" />
    <xsl:param name="script_import" select="'1'" />
    <!--  Include only for widget view -->
    <xsl:if test="$show_expert_search_widget_view = '1'">
      <xsl:if test="$script_import = '1'">
        <xsl:text
          disable-output-escaping="yes"
          >&lt;script type="text/javascript"&gt;</xsl:text>
      </xsl:if>
      gsa.ui.expertsearch.init(
          '<xsl:call-template name="compose_expert_search_query_string_" />',
          '<xsl:value-of select="$dom_container" />');
      <xsl:if test="$script_import = '1'">
        <xsl:text
          disable-output-escaping="yes">&lt;/script&gt;</xsl:text>
      </xsl:if>
    </xsl:if>
  </xsl:template>

  <!--
    Includes the input field for expert search history management.
  -->
  <xsl:template name="include_expert_search_history_input">
    <xsl:if test="$show_expert_search_widget_view = '1'">
      <input id="eshistorytoken" type="hidden" />
    </xsl:if>
  </xsl:template>

  <!--
    Generates the 'back to main results' link used in the expanded mode to go
    back to the widget view results page.

    Params:
      src_prefix: The prefix that should be added to the query string.
      msg_back_to_main_results_action: Localized message string to be displayed
          for going back to the main results page containing widget view.
    Returns:
      The HTML markup containing link to go back to main results containing the
      widget view.
  -->
  <xsl:template name="back_to_widget_view_frontend_link">
    <xsl:param name="src_prefix" select="'/search?'" />
    <xsl:param name="msg_back_to_main_results_action"
        select="'Back to main results'" />
    <xsl:variable name="filtered_url">
      <xsl:for-each
          select="/GSP/PARAM[(@name != 'start') and
                             (@name != 'swrnum') and
                             (@name != 'expertsearchasync') and
                             (@name != 'proxystylesheet') and
                             (@name != 'client') and
                             (@name != 'getfields') and
                             (@name != 'dnavs') and
                             (@name != 'filter') and
                             (@name != 'num') and
                             (@name != 'originalquery') and
                             (@name != 'emmain') and
                             (@name != 'emsingleres') and
                             (@name != 'emdstyle') and
                             (@name != 'expertsearchexpand') and
                             (@name != 'expertsearch') and
                             (@name != 'expertsearchfrontend') and
                             (@name != 'q') and
                             (@name != 'noscript_mode') and
                             (@name != 'epoch') and
                             not(starts-with(@name, 'metabased_'))]">
        <xsl:value-of select="@name"/><xsl:text>=</xsl:text>
        <xsl:value-of select="@original_value"/>
        <xsl:if test="position() != last()">
          <xsl:text disable-output-escaping="yes">&amp;</xsl:text>
        </xsl:if>
      </xsl:for-each>
    </xsl:variable>
    <xsl:variable name="back_to_link_href">
      <xsl:value-of select="$src_prefix" />
      <xsl:value-of select="$filtered_url" />
      <xsl:text disable-output-escaping="yes">&amp;q=</xsl:text>
      <xsl:value-of select="$original_query_" />
      <xsl:text disable-output-escaping="yes">&amp;proxystylesheet=</xsl:text>
      <xsl:value-of select="$expert_search_proxystylesheet_" />
      <xsl:text disable-output-escaping="yes">&amp;client=</xsl:text>
      <xsl:value-of select="$expert_search_proxystylesheet_" />
    </xsl:variable>
    <xsl:if test="$expert_search_proxystylesheet_ != ''">
      <a>
        <xsl:attribute name="href" select="$back_to_link_href" />
        <xsl:text>&lt;&lt; </xsl:text>
        <xsl:value-of select="$msg_back_to_main_results_action" />
      </a>
    </xsl:if>
  </xsl:template>

  <!--
    Renders the HTML markup for the expert search results section.

    Params:
      src_prefix: The prefix that should be added to the query string.
      is_noscript_mode: Set to 'true' if markup related to the noscript scenario
          should be returned.
      current_search_query_args: The current query string extracted from the
          absolute incoming search request params.
      msg_expert_search_no_experts_found: Localized message string to be
          displayed when no result(s) are present.
      msg_expert_search_switch_to_expanded_mode: Localized message string to be
          displayed for switching to the expanded mode.
      msg_results_page_number_prefix: Localized message string to be displayed
          as prefix for the search results page number.
      msg_go_to_previous_page: Localized message string to be displayed for
          going to previous results page help text.
      msg_go_to_previous_page: Localized message string to be displayed for
          going to next results page help text.
      msg_previous_page_action: Localized message string to be displayed for the
          previous page action link.
      msg_next_page_action: Localized message string to be displayed for the
          next page action link.
    Returns:
      The HTML markup containing expert results section.
  -->
  <xsl:template name="render_expert_search_results">
    <xsl:param name="src_prefix" select="'?'" />
    <xsl:param name="is_noscript_mode" select="'false'" />
    <xsl:param name="current_search_query_args" select="''" />
    <xsl:param name="msg_expert_search_no_experts_found"
        select="'No expert(s) found.'" />
    <xsl:param name="msg_expert_search_switch_to_expanded_mode"
        select="'Switch to the expert search results expanded mode'" />
    <xsl:param name="msg_results_page_number_prefix" select="'Page'" />
    <xsl:param name="msg_go_to_previous_page"
        select="'Go to the previous results page'" />
    <xsl:param name="msg_go_to_next_page"
        select="'Go to the next results page'" />
    <xsl:param name="msg_previous_page_action" select="'Prev'" />
    <xsl:param name="msg_next_page_action" select="'Next'" />
    <xsl:choose>
      <!-- Return iframe to handle noscript scenario. -->
      <xsl:when test="$is_noscript_mode = 'true'">
        <xsl:call-template
            name="render_expert_search_results_in_noscript_mode_">
          <xsl:with-param name="src_prefix" select="$src_prefix" />
        </xsl:call-template>
      </xsl:when>
      <!--
        Return full HTML document when results are not requested through the
        JavaScript component and it's not expanded mode. This happens in
        the noscript mode or when directly opening the widget view in browser
        without JavaScript component requesting the same.
      -->
      <xsl:when test="(not($is_expert_async_search_) and
          not($is_expanded_mode_)) or $noscript_mode_ = 'true'">
        <xsl:text disable-output-escaping="yes">&lt;</xsl:text>
        <xsl:text disable-output-escaping="yes">!DOCTYPE html</xsl:text>
        <xsl:text disable-output-escaping="yes">></xsl:text>
        <html>
          <head>
            <xsl:call-template name="include_expert_search_css" >
              <xsl:with-param name="doc_dir" select="'ltr'" />
              <xsl:with-param name="src_prefix" select="'//static-gsa.s3-website-ap-southeast-2.amazonaws.com'" />
            </xsl:call-template>
          </head>
          <body>
            <div id="exp-results-container"></div>
            <xsl:call-template name="include_expert_search_js" />
            <xsl:call-template name="include_expert_search_js_init">
              <xsl:with-param name="dom_container"
                  select="'exp-results-container'" />
            </xsl:call-template>
            <noscript>
              <xsl:call-template name="render_expert_search_results_">
                <xsl:with-param name="href_prefix" select="$src_prefix" />
                <xsl:with-param name="current_search_query_args"
                    select="$current_search_query_args" />
                <xsl:with-param name="msg_expert_search_no_experts_found"
                    select="$msg_expert_search_no_experts_found" />
                <xsl:with-param name="msg_expert_search_switch_to_expanded_mode"
                    select="$msg_expert_search_switch_to_expanded_mode" />
                <xsl:with-param name="msg_results_page_number_prefix"
                    select="$msg_results_page_number_prefix" />
                <xsl:with-param name="msg_go_to_previous_page"
                    select="$msg_go_to_previous_page" />
                <xsl:with-param name="msg_go_to_next_page"
                    select="$msg_go_to_next_page" />
                <xsl:with-param name="msg_previous_page_action"
                    select="$msg_previous_page_action" />
                <xsl:with-param name="msg_next_page_action"
                    select="$msg_next_page_action" />
              </xsl:call-template>
            </noscript>
          </body>
        </html>
      </xsl:when>
      <!--
        If the request is asynchronous via the JavaScript component then only
        return the results section markup.
      -->
      <xsl:otherwise>
        <xsl:call-template name="render_expert_search_results_">
          <xsl:with-param name="href_prefix" select="$src_prefix" />
          <xsl:with-param name="current_search_query_args"
              select="$current_search_query_args" />
          <xsl:with-param name="msg_expert_search_no_experts_found"
              select="$msg_expert_search_no_experts_found" />
          <xsl:with-param name="msg_expert_search_switch_to_expanded_mode"
              select="$msg_expert_search_switch_to_expanded_mode" />
          <xsl:with-param name="msg_results_page_number_prefix"
              select="$msg_results_page_number_prefix" />
          <xsl:with-param name="msg_go_to_previous_page"
              select="$msg_go_to_previous_page" />
          <xsl:with-param name="msg_go_to_next_page"
              select="$msg_go_to_next_page" />
          <xsl:with-param name="msg_previous_page_action"
              select="$msg_previous_page_action" />
          <xsl:with-param name="msg_next_page_action"
              select="$msg_next_page_action" />
        </xsl:call-template>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- ************ END OF PUBLIC VARIABLES AND TEMPLATES  *************  -->

  <!--
    Matches the root element and calls the expert search template if test_mode
    is enabled. This is mainly used during development.
  -->
  <xsl:template match="/">
    <xsl:if test="$test_mode = '1'">
    <xsl:choose>
      <xsl:when test="$is_expert_search_configured = '1'">
        <xsl:call-template name="render_expert_search_results" />
      </xsl:when>
    </xsl:choose>
    </xsl:if>
    <xsl:if test="$test_mode = '0'">
      <xsl:apply-templates />
    </xsl:if>
  </xsl:template>
</xsl:stylesheet>


