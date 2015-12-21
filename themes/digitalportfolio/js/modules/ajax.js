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
			dataType: 'html',
			success: function(data){
				var content = $(data).filter('#main');
				$('#main').html(content);
			}
		});
	};

	return ajax;

});