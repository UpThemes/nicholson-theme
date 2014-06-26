/**
 * jQuery Functions and what-not
 *
 * @package Nicholson
 * @since 1.0.1
 */

jQuery(function($) {
	var $container = $('#portfolio');
	// initialize isotope
	$container.isotope({
		layoutMode: 'fitRows',
	});

	// filter items when filter link is clicked
	$('#filters a').click(function(){
	    var selector = $(this).attr('data-filter');
	       	$container.isotope({ filter: selector });
	        return false;
	   	});
});

jQuery(function($){
	$('.fade').mosaic({
		animation	:	'fade',	//fade or slide
		hover_x		:	'400px',		//Horizontal position on hover
		speed		: 	'150', 
	});
 });
