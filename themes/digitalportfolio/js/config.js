/**
 * File name: 	config.js
 *
 * Description: Sets requirejs options and loads our app with the 
 *				needed dependencies and libraries.  Paths to 
 * 				libraries need to be set here in order for them
 *  			to work with the app.
 *
 * Notes: 		- For this project, paths are included inside Gruntfile.js.   
 *
 *				- js_dir.path is set inside from the functions.php entique script function.
 * 				  this is so WordPress can set the baseUrl based on the enviorment.
 *
 */

requirejs.config({

	baseUrl: dir.path
});

requirejs(['jquery','require', 'app']);