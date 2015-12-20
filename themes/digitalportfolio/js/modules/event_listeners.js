define(function(){

	'use strict';

	var listeners = {
		'prevent_default': addEventListener('click', function(event){
			event.preventDefault();
		}, false);
	}	
});