$(function(){
	$('#searchCourse').click(function(){
		$.ajax({
			url: "courses/help",
			data: {course_id : $('#courseSelection').val()},
			success: function(data){
				knowledge = JSON.parse(data);

				$('td').removeClass('success warning danger');

				$('td > a').each(function(index, link){
					td = $(link).parent();
					ta_name = $(link).text();
					if ( knowledge[ta_name] == 5 )
						td.addClass('success').removeClass('warning danger');
					else if (knowledge[ta_name] >= 3 && ! td.hasClass('success'))
						td.addClass('warning').removeClass('danger');
					else if (! (td.hasClass('warning') || td.hasClass('success')) )
						td.addClass('danger');
				});
			}
		});
	});
});