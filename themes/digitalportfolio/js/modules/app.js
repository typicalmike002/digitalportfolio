define(function (require) {

	'use strict';

	// Modules and Libraries:
	var $ = require('jquery'),
		ajax = require('./modules/ajax'),
		link = require('./modules/link'),

		// Local divs in html used for ajax:
		nav = 'nav',
		main = 'main',
		logo = 'site-logo';

	// Sets sendRequest as the default link behavior for the following divs:
	link.addEvent( logo, sendRequest );
	link.addAllEvents( nav, sendRequest );
	link.addAllEvents( main, sendRequest );

	// Browser 'back', 'foward', and 'refresh' will send ajax request:
	// This is my fix for when ajax breaks these buttons.
	if (window.addEventListener) {
		window.addEventListener('popstate', function(){
			var url = window.location.pathname.split('/').pop();
			ajax.loadContent( url, ajaxSuccess );
		}, false);
	}

	// Event that is used for sending ajax requests.
	function sendRequest(event){
		event.preventDefault();
		ajax.loadContent( link.href(this), ajaxSuccess );
		ajax.pushState( link.href(this) );
	}

	// Function that is executed when the ajax returns 200.
	function ajaxSuccess(data){
		var content = $( data ).filter( '#main' );
		$( '#main' ).fadeOut('slow', function(){
			$( '#main' ).empty().append( content ).fadeIn( 'slow', function(){
				
				// Adds events to links found inside the main div:
				link.addAllEvents( main, sendRequest );
			} );
		});
	}


});