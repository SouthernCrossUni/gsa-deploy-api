$(window).ready(function() {
	$('span.collapse').text('-')
		 
	
	$('.dn-hdr').click(function() {
		 if (!($(this).hasClass('collapsed'))) 
		 {
		   var contentHeight = $(this).parent().height();
		   $(this).attr('data-height', contentHeight);
		   $('#dyn_nav_col').slideUp();
		   $(this).addClass('collapsed');
		   $('span.collapse').addClass('open');
		   $('span.collapse').removeClass('collapse');
		   $('span.open').text('+')
		 } 
		 else 
		 {
		   var contentHeight = $(this).data('height');
		   $('#dyn_nav_col').css('height', contentHeight);
		   $('#dyn_nav_col').slideDown();
		   $(this).removeClass('collapsed');
	       $('span.open').addClass('collapse');
		   $('span.open').removeClass('open');
		   $('span.collapse').text('-')
		}
		 
		});	

});