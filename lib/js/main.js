/**
 * Main jQuery stuff
 */

jQuery(function($) {
	$('.site-menu .menu li').find('ul').show().hide();
    	
    $('.site-menu .menu li').hover(function() {
        $(this).children('ul').slideToggle(200);
    }, function() {
    	$(this).children('ul').delay(100).slideToggle(300);
    });
});

jQuery(function($) {
	$(".site-menu .sub-menu").hover(
   		function() {
    		$(this).closest('li').toggleClass('hovered');
   		},
   		function() {
      		$(this).closest('li').toggleClass('hovered');
   		}
	);
});
