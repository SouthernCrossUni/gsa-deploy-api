(function($){
	
	//create object extension for jquery show())
	var _oldShow = $.fn.show;
	/**
	 * Extended show() jquery method
	 * this is to add two event listener triggers on DOM elements
	 * after and before the show method itself.
	 * 
	 * This allows for modular approaches to DOM bindings
	 * reducing code duplication
	 */
    $.fn.show = function (speed, oldCallback) {
        return $(this).each(function () {
			//construct _self object with a callback function
            var obj = $(this),
                newCallback = function () {
					//apply the function as a callback
                    if ($.isFunction(oldCallback)) {
                        oldCallback.apply(obj);
                    }

					//construct trigger call afterShow in the extended object
                    obj.trigger('afterShow');
                };
			//construct trigger call beforeShow in the extended object
            obj.trigger('beforeShow');

			//apply the new extensible into the jquery show() method
            _oldShow.apply(obj, [speed, newCallback]);
        });
    },
    //used to boolean an offshore context
	$.fn.offshoreContext = function() {
		return (
				//has the int-off radio been checked in an action
				($('#dom-int-intakes' + domIntSeparator + 'OFFSHORE').is(':checked'))
				//or has either the bbj.js state been set to int or has the int-off bbj.js state been set to a definable entity that isnt 'true'
				|| ( $.bbq.getState('dom-int-intakes-OFFSHORE') == true || typeof $.bbq.getState('dom-int-intakes-OFFSHORE') != 'undefined' )
		);
	},
	//simple trigger function to set the presentation of onshore and offshore locations on the search form
	$.fn.offshoreToggle = function() {
		//has the offshore context been triggered
		if ($.fn.offshoreContext()) {
//			console.log('* offshore form mode activated');	
			//display offshore location div
			$('#offshore-location-cont').show();
			$.fn.fetchDomOffshore();
		} else {
//			console.log('* * onshore form mode activated');
			//display onshore location div
			$('#location-cont').show();			
		}
		
	},
	
	$.fn.uncheckAll = function () {
		$(this).each(function() {
			if ($(this).attr('checked')) {
				$(this).attr('checked', false);
				$.bbq.removeState($(this).attr('id'));
			}
		});
		
	},
	//function to retrieve domestic availabilities that are accessible via offshore (e.g NZ MIT)
	$.fn.fetchDomOffshore = function() {
		if ($('.dom-avails .offshore').length > 0) {
			$('.dom-avails .offshore, .dom-avails .U').each(function(){
				var $domOffshore = $(this).clone();
				var locDesc = $domOffshore.find('td:first').text();
				var $sibling = $(this).parents('.dom-avails').siblings('.int-avails');
				
				if ($sibling.find('.avail-details').length === 0) {
					var $availHead = $(this).siblings('.avail-details').clone();
					var availText = $availHead.find('td:first').text().replace(/Domestic/, 'International');
					$availHead.find('td:first').text(availText);
					$sibling.find('tbody').append($availHead);
				}
				
				$sibling.find('')
				//remove any that had no availability disclaimer before seeding
				$sibling.find("tbody tr:not('[class*=offshore]'):not('[class*=avail-details]')").remove();
				if (!$sibling.find("tbody tr:contains('" + locDesc + "')").length > 0) {
					$sibling.find('tbody').append($domOffshore);
				}
			});
			}
	}
})(jQuery);

var domIntSeparator = ( window.location.href.indexOf('unit') > -1) ? '\\:' : '-'; 

$(document).ready(function() {
	//have offshore elements been loaded and assigned (they are using a web service delivery)
	//this is required for any web service entity
	$('#offshore-location-cont').ready(function() {
		
		//parse h3. offshore class selector and remove ' (Offshore)'
		//this is to support graceful degradation to distinguish between onshore and offshore location sections if JS is off
		var parsedHtml = $('h3.offshore').html().replace(/\s\(Offshore\)/, '');
		//set the parsed string as the new html value
		$('h3.offshore').html(parsedHtml);
		
		//attach beforeShow (see above extented show method) event listener to offshore-location-cont div element 
		$('#offshore-location-cont').bind('beforeShow', function() {			
			//hide the onshore location container
			$('#location-cont, tr.onshore').hide();
			//transfer an active ui state to the offshore heading
			if ($('h3.onshore').hasClass('ui-state-active')) {
				$('h3.onshore').removeClass('ui-state-active');
				$('.filter-choice.onshore input').uncheckAll();
				//set bbq.js state to false for onshore (to prevent duplicate hash changes)
				setBBQaccordionState($('h3.onshore'), false);		
				$('h3.offshore').click();
			}
		});
		
		//attach beforeShow (see above extented show method) event listener to location-cont div element 
		$('#location-cont').bind('beforeShow', function() {
			//hide the offshore location container
			$('#offshore-location-cont, tr.offshore').hide();
			//transfer an active ui state to the onshore heading
			if ($('h3.offshore').hasClass('ui-state-active')) {
				$('h3.offshore').removeClass('ui-state-active');
				$('.filter-choice.offshore input').uncheckAll();
				//set bbq.js state to false for offshore (to prevent duplicate hash changes)
				setBBQaccordionState($('h3.offshore'), false);		
				$('h3.onshore').click();
			}
		});
				
		$.fn.offshoreToggle();
		
		$('input[id*="dom-int-intakes"]').click(function() {
			$.fn.offshoreToggle();
		});
		
	})		
	//below is not dependent on web service deliverables
	//so leave outside the offshore wrapper
	$('#GSA-search-form').change(function() {
			$.fn.offshoreToggle();
	});
});

function initAccordion() {
	$('#filtering h3.ui-collapse').click(function() {
		$(this).next().slideToggle('900');
		$(this).toggleClass('ui-state-active');
		setBBQaccordionState($(this), $(this).hasClass('ui-state-active'));		
		return false;
	}).next().hide();
}

function showAvails() {
	var selectYear = $('#year').val();
	var type = $('input[id*="dom-int-intakes"]').attr('type');
	$(".dom-avails").hide();
	$(".int-avails").hide();

	$('input[id*="dom-int-intakes"]').each(function() {
		var availTo = $(this).val();
		if (typeof availTo != 'undefined') {
			if ($(this).is(':checked')) {
				if (availTo == 'DOM' || availTo == 'INT-ON') {
					$(".dom-avails").show();
				}
				if (availTo == 'OFFSHORE') {
					$(".int-avails").show();
				}
			}
		}
	 });
	if (type == 'checkbox' && !$('input[id*="dom-int-intakes"]').is(':checked')) {
		$(".dom-avails").show();
		$(".int-avails").show();
		$('.avails, .int-avails').each(function(){
			$(this).find("table tr td:contains('confirmed')").hide();
		});
	}
}

function isLandingPage() {
	//return ($('.search-landing-tabs:visible').length && $.bbq.getState('keyword') == undefined);
	return ($.bbq.getState('source') == undefined && $.bbq.getState('keyword') == undefined);
}

function insertFakeNum() {
	if ($('#fake-num').length == 0) {
		$('#course-content').prepend('<input type="hidden" name="num" id="fake-num" value="10"/>');
	}
}

//function cleanHash() {
//	var clnHash = location.hash;	
//	//var keyword = $.bbq.getState( 'keyword' );
//	var source = $.bbq.getState( 'source' );
//	//if (keyword) {
//	//	clnHash = clnHash.replace(/keyword=.*?&?/, '');
//	//}
//	if (source) {
//		clnHash = clnHash.replace(/source=.*?&?/, '');
//	}
//	return (clnHash);
//}

function hashLinks() {
		$('#re a, #n a, #ss a').each(function(){
				var that = $(this);
				if (!that.hasClass('no-hash')) {
					var href = '';
					var clnHash = location.hash;//cleanHash();
					if (!that.hasClass('l')) { 
						href = that.attr( 'href' ).replace(/(.*?)#.*?/, '$1');
						that.attr( 'href', href+clnHash+'&source=nav' );
						//that.attr( 'href', href+'&source=nav'+'#'+$('#GSA-search-form').serialize()+'&keyword='+$('#GSA-search-input').val()+'&source=nav' );
						//that.attr( 'href', href+'#'+$('#GSA-search-form').serialize()+'&source=nav' );
					} else if ($('#dom-int-intakes' + domIntSeparator + 'INT').is(':checked')) {
						href = that.attr( 'href' );
						that.attr( 'href' , href+'#intdom=international');
					}
				}
		});
}

//function showFilters() {
//	$(".filter-option").each(function(){
//		if ($(this).hasClass(selType + "-content") && $(this).hasClass($("#search-type").attr("value") + "-content")) {
//			$(this).show();
//		} else {
//			$(this).hide();	
//		}
//	});
//}

function search() {
	//setFilterSource();
	setKeywordState();
	var formstr = $('#GSA-search-form').serialize();
	var datastr = formstr + '&ajax=1';
	var lastSearch = $('#last-search').val();
	if (formstr != lastSearch) {
		$('#results-cont').html('<div id="su" class="refresh"><p>refreshing...</p></div><p id="refresh"></p>');
		$.ajax({
			url:'/courses/',
			data:datastr
		}).done(function(html){
			$('#results-cont').html(html);//.replace(/<a href="\?(.*?)"/gm, '<a href="?$1'+location.hash+'&source=nav"'));
			$('#fake-num').remove();
			setLastSearch(formstr);
			showAvails();
			hashLinks();
			$('#su select').each(setBBQfilterSelect);
			initNumSelect();
			$.fn.offshoreToggle();			
		});
	}
}