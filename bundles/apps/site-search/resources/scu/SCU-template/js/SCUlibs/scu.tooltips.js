/** tooltip loader instance **/
/** example use **/

/** var settings = { tip: { 
                            show: false, 
                            hide: false
                        },
                    custom: { arrow: { anchorage: "bottom"
                        } 
                    }};
      
      $('.prec-websearch-container [title]').each(function() {
          var scu_tooltip = new $.SCUTooltip($(this), settings);
          scu_tooltip.Load();
      });**/
      
(function ($) { 
    $.SCUTooltip = function (element,settings) {
        //stores the passed element as a property of the created instance.
        this.element = (element instanceof $) ? element : $(element);
        this.tip = settings.tip;
        this.custom = (typeof settings.custom !== "undefined") ? settings.custom : {arrow: {anchorage: "bottom"}};
        //constant for arrow div embed
        this.arrow = $("<div>").addClass('arrow');
    };

    //assigning an object literal to the prototype is a shorter syntax
    //than assigning one property at a time
    $.SCUTooltip.prototype = {
    		getPositions: function() {
    			return this.positions;
    		},
    		setPositions: function(obj) {
    			this.positions = obj;
    		},
    		appendArrow: function(){
    			this.tip.content =  this.arrow[0].outerHTML + this.element.attr('title');
    		},
	    	Load: function() {
	    		console.log(this.arrow);
	    		var defaultPos = { 
    			"top":		{ my: 'center bottom-20', 	at: 'center top' },
    			"bottom": 	{ my: 'center top+20', 	at: 'center bottom' },
    			"left": 	{ my: 'right-30 center', 	at: 'left center' },
    			"right":	{ my: 'left+30 center', 	at: 'right center' }
    		};
	    		var positions = (typeof this.positions !== "undefined" && this.postions.length == 0) ? this.positions : defaultPos;
	    		
	    		if (this.custom.arrow.anchorage.length > 0) {
	    			var anchorage = this.custom.arrow.anchorage;
					var position = positions[anchorage];
					this.tip.position = position;
					this.arrow.addClass(anchorage);
					this.tip.tooltipClass = anchorage;
	    		}
	    		this.appendArrow();
	    		if (typeof this.element.attr('title') !== "undefined") {
	    			this.element.tooltip(this.tip);
	    		}
			}
        };
}(jQuery));