/**
 * app.js
 *
 * Load all modules here by calling require.  
 *
*/

define(function() {

	'use strict';

	// Hides the, 'enable javascript' message when the app is loaded.
	var no_js_div = document.getElementById('js-disabled');
	no_js_div.parentElement.removeChild(no_js_div);

	require('./modules/navigation');
	require('./modules/gallery');

});