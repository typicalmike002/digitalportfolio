/**
* Module gallery.js
* 
* Used to setup the theme's masonry gallery.  For some reason, requirejs
* refuses to load the depencencies automatically but they are only used here.
*/
define(['domReady', 'masonry', 'lazyload', 'lightbox'],
	function(domReady, Masonry, lazyload, lightbox) {

	// Note: Lazyload requires this function to load first.
	var loadMasonry = function() {
		var grid = document.querySelector('.masonry-container'),
			msnry = new Masonry( grid, {
				itemSelector: '.masonry-item'
			});
	};

	lightbox.option({
		'resizeDuration': 100,
		'wrapAround': true
	});
	
	domReady(function(){
	
		$("img.lazy").lazyload({
			effect: 'fadeIn',
			effectspeed: 1000,
			threshold: 200,
			load: loadMasonry
		});
	});
	
});