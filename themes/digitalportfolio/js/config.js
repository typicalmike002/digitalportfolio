/**
 * Requirejs main config file used for loading modules and their dependencies.
 * Paths to libraries and the main app file need to be found in the 
 * Gruntfile inside the path object.
 *
 * js_dir.path is inherited from the functions.php entique script function.
 */

requirejs.config({

	baseUrl: dir.path

});

requirejs(['jquery', 'app']);