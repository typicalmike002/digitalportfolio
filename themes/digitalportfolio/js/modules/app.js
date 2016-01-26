define(function (require) {

	'use strict';

	// Modules and Libraries:
	var $ = require('jquery'),
		ajax = require('./modules/ajax'),
		link = require('./modules/link'),

		nav = 'nav',
		main = 'main',
		logo = 'site-logo';

	// Attaches the sendRequest function as a 'click' event
	// to all <a> tags inside the above divs:
	link.addEvent( logo, sendRequest );
	link.addAllEvents( nav, sendRequest );
	link.addAllEvents( main, sendRequest );

	// Browser 'back', 'foward', and 'refresh' will send ajax request:
	// This is my fix for when ajax breaks these buttons.
	if (typeof window.addEventListener === 'function') {
		window.addEventListener('popstate', function(){
			var url = window.location.pathname.split('/').pop();
			ajax.loadContent( url, ajaxSuccess );
		}, false);
	}

	// This function is used as a 'click' event that
	// sends an ajax request and pushes the results 
	// into the users history with pushState();
	function sendRequest(event){
		event.preventDefault();
		ajax.loadContent( link.href(this), ajaxSuccess );
		ajax.pushState( link.href(this) );
	}

	// Function that is executed when the ajax request returns 200.
	function ajaxSuccess(data){

		//Retrive data's title:
		var title = $( data ).filter( 'title' )[0].innerText;
		
		//Retrive data's 'main' content:
		var content = $( data ).filter( '#main' ).html();

		//Switches currently loaded page with above 
		//also adds a jQuery fadeOut fadeIn effect:
		document.title = title;
		$( '#main' ).fadeOut('slow', function(){
			$( '#main' ).empty().append( content ).fadeIn( 'slow', function(){
				
				// Adds events to links found inside the main div:
				link.addAllEvents( main, sendRequest );
			});
		});
	}
});