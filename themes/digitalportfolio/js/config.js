requirejs.config({

	baseUrl: js_dir.path,

	deps: ["jsSrc/globals"],

	paths: {
		jquery: "libs/jquery-1.11.3.min"
	}
});

requirejs(['jquery'], function($){

});
