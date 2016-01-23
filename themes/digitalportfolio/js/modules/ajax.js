define(function (require) {

	var ajax = {

		// Loads the content and executes the eventFunc on success:
		'loadContent': function(url, eventFunc){

			var data = {
				'action': 'get_content',
				'request': url
			};

			$.ajax({
				type: "POST",
				url: url,
				data: data,
				async: true,
				dataType: 'html',
				success: eventFunc
			});
		},

		// This function is called separetly because the back button fix
		// wont work when pushState is called in the 'popstate' event:
		'pushState': function(url){
			state = { page: url };
			history.pushState( state, '', url );
			
		}
	};

	return ajax;

});