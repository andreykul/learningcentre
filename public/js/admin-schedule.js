$(function(){
	$('td').click(function(){
		day = $(this).attr('id').split('-')[0];
		window.location.href = 'schedule/day?day='+day;
	});

	$('#publish').click(function(){
		$('.modal').modal();
	});

	$('.date-input').datepicker({
		dateFormat: "yy-mm-dd",
		minDate: 0
	});

	$('.resetSchedule').click(function(){
		form = $(this).parent();
		bootbox.dialog({
			message: "Are you sure?",
			title: "Reset Schedule",
			buttons: {
				danger: {
					label: "Reset",
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