define(function(require) {

	'use strict';

	var nav = {};

	nav.get_links = function(id){
		var div = document.getElementById('nav'),
			links = div.getElementsByTagName('a');
		
		if ( links.length < id ){
			return 'Array out of bounds error';
		} else {
			return links[id];
		}
	};

	return nav;
});