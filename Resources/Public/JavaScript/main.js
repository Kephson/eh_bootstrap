$(document).ready(function () {
	$('#dataLoader').on('click', function () {
		console.log('done');
		$.ajax({
			async: 'true',
			url: 'index.php',
			type: 'POST',
			data: {
				eID: "ehBootstrap",
				request: {
					pluginName: 'ehbs',
					controller: 'Abstract',
					action: 'render',
					arguments: {
						'example': 'test'
					}
				}
			},
			dataType: "html",
			success: function (result) {
				console.log('successfull');
				$('#ajaxData').html(result);
			},
			error: function (error) {
				console.log(error);
			}
		});
	});
});
