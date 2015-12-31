define(function (require) {

	'use strict';

	var $ = require('jquery'),
		ajax = require('./modules/ajax'),
		nav = require('./modules/nav');

	//Enables ajax request for navigation links:
	for (var i = 0, l = nav.links_length(); i < l; i++ ) {
		var ajax_enabled_nav = nav.get_links(i);
		ajax_enabled_nav.addEventListener('click', function(event){
			event.preventDefault();
			ajax.load_content( nav.get_href(this) );
			ajax.push_state( nav.get_href(this) );
		}, false);
	}
});