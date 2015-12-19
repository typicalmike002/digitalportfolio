/**
 * Requirejs main config file used for loading modules and their dependencies.
 * Paths to libraries and the main app file need to be found in the 
 * Gruntfile inside the path object.
 */

requirejs.config({

	baseUrl: js_dir.path,

});

requirejs(['jquery', 'app']);