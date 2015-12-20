define(function (require) {

	'use strict';

	var $ = require('jquery'),
		ajax = require('./modules/ajax'),
		navigation = require('./modules/navigation');

	jQuery(document).ready(function($) {
		ajax.get_content();
	});

	console.log( navigation.get_links() );
	

});