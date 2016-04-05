/**
* Module navigation.js
* 
* Handles all navigation events for the theme.
*
*/
define(function(){
	
	// Allows the navigation to stick to the top when the user
	// scrolls past the header.  Adds margin-top property to 
	// #main to allow smooth scrolling.
	var navContainer = $('#nav'),
		navScrolled = "nav-scrolled",
		headerHeight = $('header').height();

	$(window).scroll(function() {
		if ( $(this).scrollTop() > headerHeight-50 ) {
			navContainer.addClass(navScrolled);
		} else {
			navContainer.removeClass(navScrolled);
		}
	});
});