define(function(require) {

	'use strict';

	var nav = {};

	nav.get_links = function(){
		let div = document.getElementById('nav'),
			links = div.getElementsByTagName('a'),
			anchor = [];

		for (var i = 0, l = links.length; i < l; i++){
			anchor = links[i];
			anchor.addEventListener('click', function(event){
				event.preventDefault();
				var url = this.getAttribute('href');
				nav.urls.push(url);
			}, false);
		}
	};

	return nav;

});