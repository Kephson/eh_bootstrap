$(document).ready(function () {
	// [Example-6]: loading via eId
	$('#dataLoader').on('click', function () {
		var ajaxTime = new Date().getTime();
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
				var totalTime = new Date().getTime() - ajaxTime;
				$('#ajaxTime').html('Loading time: ' + totalTime + 'ms');
			},
			error: function (error) {
				console.log(error);
			}
		});
	});
	// [Example-7]: loading via typoscript_rendering
	$('#dataLoader2').on('click', function () {
		var ajaxTime = new Date().getTime();
		var ajaxUri = $(this).data('uri');
		$.ajax({
			async: 'true',
			url: ajaxUri,
			type: 'POST',
			dataType: "html",
			success: function (result) {
				console.log('successfull');
				$('#ajaxData').html(result);
				var totalTime = new Date().getTime() - ajaxTime;
				$('#ajaxTime').html('Loading time: ' + totalTime + 'ms');
			},
			error: function (error) {
				console.log(error);
			}
		});
	});
});
