define(function (require) {

	'use strict';

	var $ = require('jquery'),
		ajax = require('./modules/ajax'),
		nav = require('./modules/nav');

	// jQuery(document).ready(function($) {
	// 	ajax.get_content();
	// });

	var links = nav.get_links(1);

	console.log(links);

	

});