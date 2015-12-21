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
			async: true,
			success: replace_content,
			dataType: 'html'
		});

		function replace_content( data ) {
			$('#main').html(data);
		}

	};

	return ajax;

});