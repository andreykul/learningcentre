$(function(){
	$('.shift-own').hover(function(){
		$(this).toggleClass('success');
		$(this).toggleClass('danger');
		$(this).toggleClass('text-danger');
		$(this).children('p').show();
	},function(){
		$(this).toggleClass('success');
		$(this).toggleClass('danger');
		$(this).toggleClass('text-danger');
		$(this).children('p').hide();
	});

	$('.shift-own').click(function(){
		$(this).children('form').submit();
	});
});