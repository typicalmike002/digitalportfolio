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
			success: change_content
		});

		function change_content(data){
			var content = $( data ).filter( '#main' );
			$( '#main' ).fadeOut('slow', function(){
				$( '#main' ).empty().append( content ).fadeIn( 'slow' );
			});
		}
	};

	ajax.push_state = function(url) {
		var state = { page: url };
		history.pushState(state,'', url);
	};

	// Pressing back will get the last page in history.
	if(window.addEventListener) {
		window.addEventListener('popstate', function() {
			var url = window.location.pathname.split('/').pop();
			ajax.load_content(url);
		}, false);
	}

	return ajax;

});