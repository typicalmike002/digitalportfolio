define(function() {

	var ajax = {};

	ajax.load_content = function(request){

		var data = {
			'action': 'get_content',
			'nonce': request
		};

		jQuery.post(dir.ajax_url, data, function(response){
			
		});
	};

	return ajax;

});