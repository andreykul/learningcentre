$(function(){
	$('#searchCourse').click(function(){
		$.ajax({
			url: "courses/help",
			data: {course_id : $('#courseSelection').val()},
			success: function(data){
				knowledge = JSON.parse(data);

				$('td > a').each(function(index, link){
					td = $(link).parent();
					td.removeClass('success warning danger');
					ta_name = $(link).text();
					if ( knowledge[ta_name] == 5)
						td.addClass('success');
					else if ( knowledge[ta_name] >= 3)
						td.addClass('warning');
					else td.addClass('danger');
				});
			}
		});
	});
});