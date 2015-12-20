define(function(require) {

	'use strict';

	var nav = {};

	nav.get_links = function(){
		var div = document.getElementById('nav'),
			links = div.getElementsByTagName('a');

		return links;
		
	};

	return nav;

});