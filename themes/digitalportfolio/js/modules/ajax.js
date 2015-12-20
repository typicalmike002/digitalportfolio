define(function() {

	var ajax = {};

	ajax.load_content = function(request){

		var data = {
			'action': 'get_content',
			'nonce': request
		};

		$.ajax({
			type: "POST",
			url: request,
			data: data,
			success: replace_content,
			dataType: 'html'
		});

		function replace_content() {
			console.log(request);
		}

	};

	return ajax;

});