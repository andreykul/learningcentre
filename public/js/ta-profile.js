$(function(){
	$('.deactivateTA').click(function(){
		form = $(this).parent();
		bootbox.dialog({
			message: "Are you sure?",
			title: "Deactivate Account",
			buttons: {
				danger: {
					label: "Deactivate",
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