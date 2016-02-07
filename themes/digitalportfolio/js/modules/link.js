/* 
 * Module name: 	link.js
 *
 * Description: 	Used for attaching events to links and for getting information about a link.
 *
 * Dependencies: 	jQuery
*/

define(function () {

	var link = {

		// Organizes all clickEvent methods into this object:
		'clickEvent': {

			/*
			 * Method: 	single
			 * 
			 * Args: 	id: 		id of the div to add an event to.
			 * 			
			 *			eventFunc: 	event function to add to the div id.
			*/
			'single': function(id, eventFunc){

				// Test for Support:
				if (typeof window.addEventListener === 'function'){
					var div = document.getElementById(id);

					// Attaches an event to a single link.
					div.addEventListener('click', eventFunc, false);
				}
			},

			/*
			 * Method: 	addClickEventToAll
			 * 
			 * Args: 	id: 		id of a div that contains <a> tags.
			 * 			
			 *			eventFunc: 	event function to add to all <a> tags inside the id container.
			*/
			'all': function(id, eventFunc){

				//Only adds ajax request for browsers that use addEventListener
				if (typeof window.addEventListener === 'function'){	
					var div = document.getElementById(id),
						tags = div.getElementsByTagName('a');

					//Adds the eventFunc to each 'a' tag found in div id.
					for (var i = 0, l = tags.length; i < l; i++){
						var addEvents = tags[i];
						(function(){
							// Variable hoisting is avoided so 'i' can be used in eventFunc
							addEvents.addEventListener('click', eventFunc, false);
						}());
					}
				}
			},
		},

		// Organizes all transitionEvent methods into this object:
		'transitionEndEvent': {

			/*
			 * Method: 	single
			 * 
			 * Args: 	id: 		id of a div to add a transitionend event to
			 * 			
			 *			eventFunc: 	event function to add to the div id which gets 
			 * 						executed when the div's transition completes.
			*/
			'single': function(id, eventFunc){

				/*
				 * Function: 	transitionEnd
				 *
				 * Returns: 	the current browser's correct transitionend proporty.
				 *
				 * Notes: 		- Used to return the proper transistionend for cross browser
				 *				  compatablility.
				 */
				function transitionEnd() {

					var i,
					el = document.createElement('div'), 
					browsers = {
						'transition': 'transitionend',
						'OTransition': 'oTransitionend',
						'MozTransition': 'transitionend',
						'WebkitTransition': 'WebkitTransitionEnd'
					};

					for (i in browsers) {
						if (browsers.hasOwnProperty(i) && el.style[i] !== undefined ){
							return browsers[i];
						}
					}
				}

				var div = document.getElementById(id);
				if (window.addEventListener !== 'undefined'){

					div.addEventListener(transitionEnd(), eventFunc);
				}
			}
		},

		/*
		 * Method: 	href
		 * 
		 * Args: 	element: 	an element that contains an href attribute	
		*/
		'href': function(element){
			return element.getAttribute('href');
		}
	};

	return link;

});