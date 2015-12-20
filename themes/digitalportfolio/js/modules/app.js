define(function (require) {

	'use strict';

	var $ = require('jquery'),
		ajax = require('./modules/ajax'),
		nav = require('./modules/nav');

	// jQuery(document).ready(function($) {
	// 	ajax.get_content();
	// });

	for (var i = 0, l = nav.links_length(); i < l; i++ ) {
		var ajax_enabled = nav.get_links(i);
		console.log( ajax_enabled );
	}

	

});