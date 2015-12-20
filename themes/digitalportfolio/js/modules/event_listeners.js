define(function(){

	'use strict';

	var listeners = {
		'prevent_default': function(event){
			event.preventDefault();
		},
		'get_url': function(element){
			var url = element.getAttribute('href');
			return url;
		},
		''
	};	
});