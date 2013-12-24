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
});