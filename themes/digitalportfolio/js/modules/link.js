define(function () {

	var link = {

		// Add an event to a single element:
		'addEvent': function(id, eventFunc){

			//Only adds ajax request for browsers that use addEventListener
			if (typeof window.addEventListener === 'function'){
				var div = document.getElementById(id);

				// Attaches an event to a single link.
				div.addEventListener('click', eventFunc, false);
			}

		},

		// Add an event to all <a> tags inside an element:
		'addAllEvents': function(id, eventFunc){

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

		// Useful for getting an elements url:
		'href': function(element){
			return element.getAttribute('href');
		}
	};

	return link;

});