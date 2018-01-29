
var HashChangeHash = false;
var HasRun = false;

$(function(){

	$('.jshide').addClass('visuallyhidden');
	showAvails();
	initBBQtabs();
	initBBQfilter();
	initAccordion();
	initAdvLink();
	setLastSearch('');

	var source = $.bbq.getState( 'source' );
	if (source == 'nav') {
		$.bbq.removeState( 'source' ); // This needs to be here, not below or it may try to insert again
		HashChangeHash++;
	}
	if (source == 'nav' || (!HasRun && ($('#re').length || $('#er').length || $('#ss').length))) {
		setKeywordState();
		//HashChangeHash++;
		setIntDomState();
		HashChangeHash = true;
		hashLinks();
		setLastSearch($('#GSA-search-form').serialize());
	}

	$(window).bind( 'hashchange', function(e) {

		$('#filtering h3.ui-collapse').each(setBBQaccordion);
		$('.filter-option input').each(setBBQfilterInput);
		$('.filter-option select').each(setBBQfilterSelect);
		checkDefaultRadios();

		if (!HasRun && ($('#re').length || $('#er').length || $('#ss').length)) {
			setLastSearch($('#GSA-search-form').serialize());
		}

		if (HashChangeHash) {
			HashChangeHash = false;
			return;
		}

		if (isLandingPage()) {
			$('.bbq').each(setBBQtabs);
			dontBeTheSearch();
			insertFakeNum();
		} else {
			beTheSearch();
		}

		if (!isLandingPage()) {
			setKeyword();
			search();
			beTheSearch();
		}

		HasRun = true;
	});

	// trigger the event now, to handle the hash the page may have loaded with.
	$(window).trigger( 'hashchange' );
});

function beTheSearch() {
	$('#landing-content').hide();
	$('#search-content').show();
	$('#landing-crumbs').hide();
	$('#search-crumbs').show();
}

function dontBeTheSearch() {
	$('#landing-content').show();
	$('#search-content').hide();
	$('#landing-crumbs').show();
	$('#search-crumbs').hide();
}

function setLastSearch(lastSearchStr) {
	$('#last-search').val(lastSearchStr);
}

//function setFilterSource() {
//	var state = {},
//		id = 'source',
//		val = 'filter';
//	state[ id ] = val;
//	$.bbq.pushState( state );
//	HashChangeHash = true;
//}

// Add to / remove from bbq state when clicked
function setBBQaccordionState(el, val) {
	var state = {};
	var id = el.parent( '.filter-option' ).attr( 'id' );
	state[ id ] = val;
	if (val) { $.bbq.pushState( state ); }
	else { $.bbq.removeState( id ); }
}

// show if required on page load
function setBBQaccordion() {
	var that = $(this);
	var pnl = that.parent( '.filter-option' );
	var pnlState = ( $.bbq.getState( pnl.attr( 'id' ) ) ) ? true : false;
	if (pnlState) { that.next().show(); }
	else { that.next().hide(); }
	that.toggleClass('ui-state-active', pnlState);
}

function setKeywordState() {
	var state = {},
		id = 'keyword',
		val = $('#GSA-search-input').val();
	state[ id ] = val;
	$.bbq.pushState( state );
}

function setIntDomState() {
	var checkedOpt = ($('#dom-int-intakes-INT').is(':checked')) ? 'INT' : 'DOM';
	//if (checkedOpt == 'INT') {
		var state = {},
			id = 'dom-int-intakes-'+checkedOpt,
			val = 'true';
		state[ id ] = val;
		$.bbq.pushState( state );
	//}
}

function setKeyword() {
	var keyword = $.bbq.getState( 'keyword' );
	if (keyword != undefined) {
		$('#GSA-search-input').val( keyword );
	}
}

function initBBQfilter() {

	$('#GSA-search-input').bind( 'change', function(e) {
		setKeywordState();
	});

	$('#GSA-search-form').bind( 'submit', function(e) {
		setKeywordState();
		setLastSearch(''); //Force a new search as user wants it.
		search();
		return false;
	});
	
	// For all filter inputs, push the appropriate state onto the
	// history when clicked.
	$('.filter-option input[type!="hidden"]').bind( 'click', function(e){
		var that = $(this);
		var state = {},
			id = that.attr( 'id' ),
			val = that.attr( 'checked' );
		state[ id ] = val;

		if (val) {
			if (that.is(':radio')) {
				clearRadioState(that.attr('name'));
			}
			$.bbq.pushState( state );
		} else {
			$.bbq.removeState( id );
		}
	});

	$('.filter-option select, #su select').bind( 'change', function(e){

		var that = $(this);
		var state = {},
			id = that.attr( 'id' ),
			val = that.val();
		state[ id ] = val;

		$.bbq.pushState( state );
	});
    
    initNumSelect();
}

function initNumSelect() {
	$('select[name="num"]').bind( 'change', function(e){
		var that = $(this);
		var state = {},
			id = that.attr( 'id' ),
			val = that.val();
		state[ id ] = val;

		$.bbq.pushState( state );
	});
}

function initAdvLink() {
	$('#advanced-search-link a').click(function(){
		$('#advanced-opts, #advanced-search-link a .minus, #advanced-search-link a .plus').toggle();
		return false;
	});
}

function setBBQfilterInput() {
	var that = $(this);
	var selVal = ( $.bbq.getState( that.attr( 'id' ) ) ) ? true : false;
	that.attr('checked', selVal);
}

function clearRadioState(name) {
	$('input:radio[name='+name+']').each(function(){
		$.bbq.removeState( $(this).attr( 'id' ) );
	});
}

function checkDefaultRadios() {
	$('input:radio').each(function(){
		var name = $(this).attr('name');
		if ($('input:radio[name='+name+']:checked').length == 0) {
			$('input:radio[name='+name+'].default-opt').attr('checked', true);
		}
	});
}

function setBBQfilterSelect() {
	var that = $(this);
	var selVal = $.bbq.getState( that.attr( 'id' ) );
	if (selVal) {
		that.val(selVal);
	}
}

function initBBQtabs() {

	// For each .bbq widget, keep a data object containing a mapping of
	// url-to-container for caching purposes.
	$('.bbq').each(function(){
		$(this).data( 'bbq', {
			cache: {
				// If url is '' (no fragment), display this div's content.
				'': $(this).find('.bbq-default')
			}
		});
	});
	
	// For all links inside a .bbq widget, push the appropriate state onto the
	// history when clicked.
	$('.bbq a.bbq-link[href^=#]').bind( 'click', function(e){
		var state = {},
			// Get the id of this .bbq widget.
			id = $(this).closest( '.bbq' ).attr( 'id' ),
			// Get the url from the link's href attribute, stripping any leading #.
			url = $(this).attr( 'href' ).replace( /^#/, '' );
		
		// Set the state!
		state[ id ] = url;
		$.bbq.pushState( state );
		
		// And finally, prevent the default link click behavior by returning false.
		return false;
	});

}

function setBBQtabs() {
	var that = $(this),
		
		// Get the stored data for this .bbq widget.
		data = that.data( 'bbq' ),
		
		// Get the url for this .bbq widget from the hash, based on the
		// appropriate id property. In jQuery 1.4, you should use e.getState()
		// instead of $.bbq.getState().
		url = $.bbq.getState( that.attr( 'id' ) ) || '';

	// If the url hasn't changed, do nothing and skip to the next .bbq widget.
	if ( data.url === url ) { return; }
	//if ( url == '' ) { return; }
	
	// Store the url for the next time around.
	data.url = url;
	 
	// Remove .bbq-current class from any previously "current" link(s).
	/*url && */that.find( 'a.bbq-current' ).removeClass( 'bbq-current' );
	
	// Hide any visible ajax content.
	//that.find( '.bbq-content' ).children( ':visible' ).addClass( 'visuallyhidden' );
	that.find( '.bbq-content' ).children().addClass( 'visuallyhidden' );
	
	// Add .bbq-current class to "current" nav link(s), only if url isn't empty.
	/*url && */that.find( 'a.bbq-link[href="#' + url + '"]' ).addClass( 'bbq-current' );

	if (url == '') {
		that.find( 'a.bbq-link[href="#undergrad"]' ).addClass( 'bbq-current' );
	}
	
	// [SCU] - don't use ajax, just show or hide the container
	if ( data.cache[ url ] ) {
		// Since the widget is already in the cache, it doesn't need to be
		// created, so instead of creating it again, let's just show it!
		data.cache[ url ].removeClass( 'visuallyhidden' );
	} else {
		$('#'+url).removeClass( 'visuallyhidden' );
	}

}
