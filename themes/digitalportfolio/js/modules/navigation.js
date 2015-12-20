define(function(require) {

	'use strict';

	var nav = {};

	nav.get_links = function(){
		var div = document.getElementById('nav'),
			links = div.getElementsByTagName('a'),
			anchor = [];

		for (var i = 0, l = links.length; i < l; i++){
			anchor = links[i];
		}

		return anchor[2];

	};

	return nav;

});