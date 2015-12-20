define(function(require) {

	'use strict';

	var nav = {};

	nav.get_links = function(id){
		var div = document.getElementById('nav'),
			links = div.getElementsByTagName('a');

		return links[id];

	};

	return nav;

});