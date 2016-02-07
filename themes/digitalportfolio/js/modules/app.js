/*
 * Module name: app.js
 *
 * Description: main section of the application that is loaded
 * 				into all pages of the website.  It depends on
 * 				the other modules for their methods.  See those
 *				files to understand what they are doing here.
 *
 * Notes: 		- Libraries in the config's path do not need to 
 * 				  be called here again.
 *
 * 				- Modules do not depend on other modules to 
 * 				  work and are used to abstract some of the 
 *  			  details to keep the code more organized.
 *
*/

define(function (require) {

	'use strict';

	// 	Loads Modules:
		var ajax 	= require('./modules/ajax'),
		link 		= require('./modules/link'),

	//  Attaches ajax events to the following 
	// 	divs found inside WordPress Templates:
		nav 	= 'nav',
		main 	= 'main',
		logo 	= 'site-logo';

	/*
	 * Function: 	sendRequest(event)
	 *
	 * Deps: 		./modules/ajax
	 *				./modules/link
	 * 				ajaxSuccess(data);
	 *
	 * Notes: 		- used to attach an event to a link.
	*/
	function sendRequest(event){
		event.preventDefault();
		ajax.loadContent( link.href(this), ajaxSuccess );
		ajax.pushState( link.href(this) );
	}

	// Adds sendRequest to all links inside the divs above:
	link.clickEvent.single( logo, sendRequest );
	link.clickEvent.all( nav, sendRequest );
	link.clickEvent.all( main, sendRequest );


	/*
	 * Function: 	ajaxSuccess(data)
	 *
	 * Deps: 		./modules/link
	 *				./libraries/jquery-1.11.3.min.js
	 *				sendRequest(event);
	 *				
	 * Notes: 		- used when ajax call returns a 200 response.
	 * 				- Annimates 
	 *
	 */
	function ajaxSuccess(data){

		// Filters the data for the title and main innerHTML
		var title 	= $( data ).filter( 'title' )[0].innerText,
		content 	= $( data ).filter( main ).html(),
		div 		= document.getElementById(main);

		document.title = title; // Change the title of the document.

		div.className = 'fade_out'; // See css/sass/annimations/_annimations.scss

		link.transitionEndEvent.single(main, function(){
			$( '#main' ).empty().append( content );
			link.clickEvent.all( main, sendRequest );
			div.className = 'fade_in';
		});
	}

	// Sends ajax requests on 'popstate' (browser's back, foward, and refresh buttons)
	// using how these buttons change the url which means it can't use preventDefault();
	if (typeof window.addEventListener === 'function') {
		window.addEventListener('popstate', function(){
			var url = window.location.pathname.split('/').pop();
			ajax.loadContent( url, ajaxSuccess );
		}, false);
	}
});