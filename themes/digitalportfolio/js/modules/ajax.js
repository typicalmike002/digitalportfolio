define(function() {

	var ajax = {};

	ajax.get_content = function(request){

		var data = {
			'action': 'get_content',
			'nonce': request
		};

		jQuery.post(dir.ajax_url, data, function(response){
			alert(response);
		});
	};

	return ajax;

});