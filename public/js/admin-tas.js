$(function(){
	$('.removeTA').click(function(evt){
		evt.preventDefault();

		form = $(this).parent();
		bootbox.dialog({
			message: "Are you sure?",
			title: "Remove TA",
			buttons: {
				danger: {
					label: "Remove",
					className: "btn-danger",
					callback: function() {
						form.submit();
					}
				},
				cancel: {
					label: "cancel",
					className: "btn-default"
				}
			}
		});
	});

	$('.removeCourse').click(function(evt){
		evt.preventDefault();

		form = $(this).parent();
		bootbox.dialog({
			message: "Are you sure?",
			title: "Remove Course",
			buttons: {
				danger: {
					label: "Remove",
					className: "btn-danger",
					callback: function() {
						form.submit();
					}
				},
				cancel: {
					label: "cancel",
					className: "btn-default"
				}
			}
		});
	});
});