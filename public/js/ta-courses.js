$(function(){
	$('.star').hover(function(){
		id = $(this).attr('id');
		fillStars(id);
		clearStars(id);
	});

	$('.stars').mouseleave(function(){
		id = $(this).children('.selected').attr('id');
		if (! id){
			id = $(this).attr('id')+"-0";
		}
		fillStars(id);
		clearStars(id);
	});


	$('.star').click(function(){
		$(this).parent().children('.selected').removeClass('selected');
		$(this).addClass('selected');

		id = $(this).attr('id').split('-');
		course_id = id[1];
		knowledge = id[2];

		$.ajax({
			type: "POST",
			data: {course_id: course_id, knowledge: knowledge}
		});

	});

	function fillStars(id){
		id = id.split('-');
		course_id = id[1];
		knowledge = id[2];

		for (var i = 1; i <= knowledge; i++)
			$('#course-'+course_id+'-'+i).removeClass('glyphicon-star-empty').addClass('glyphicon-star text-warning');
	}

	function clearStars(id){
		id = id.split('-');
		course_id = id[1];
		knowledge = id[2];

		for (var i = 5; i > knowledge; i--)
			$('#course-'+course_id+'-'+i).removeClass('glyphicon-star text-warning').addClass('glyphicon-star-empty');
	}
});