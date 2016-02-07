/* 
 * Module name: 	ajax.js
 *
 * Description: 	Provides methods used with ajax calls.
 *
 * Dependencies: 	jQuery
*/

define(function () {

	var ajax = {

		/*
		 * Method: 	loadContent
		 * 
		 * Args: 	url: 		valid url request that WordPress can recognize.
		 * 			
		 *			eventFunc: 	callback function to execute if ajax request
		 *						is a success.
		 * 
		 * Notes: 	- the action 'get_content' can be found in classes/Ajax.php
		*/

		'loadContent': function(url, eventFunc){

			var data = {
				'action': 'get_content',
				'request': url
			};

			$.ajax({
				type: "POST",
				url: url,
				data: data,
				async: true,
				dataType: 'html',
				success: eventFunc
			});
		},

		/*
		 * Method: 	pushState
		 *
		 * Args: 	url:  string to be pushed into the address bar.	
		 *
		*/
		'pushState': function(url){

			if ( typeof history.pushState !== 'undefined' ) {
				state = { page: url };
				history.pushState( state, '', url );
			}
		}
	};

	return ajax;

});