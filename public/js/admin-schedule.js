$(function() {
	//Make the table selectable
	$( "#selectable" ).selectable({
		filter: "td",
		start: function(event, ui){
			$("input[name='start']").val(event.toElement.id);
		},
		stop: function(event, ui){
			start = $("input[name='start']").val();
			end = event.toElement.id;

			//End equals to start if only one cell is selected
			end = end ? end : start;

			start = start.split('-');
			start[1] = parseInt(start[1],10);
			end = end.split('-');
			end[1] = parseInt(end[1],10) + 50;

			//Start and End must have the same Day (column)
			if (start[0] != end[0]){
				//Only one error message
				if ( ! $('#error').length )
					$('#schedule').before("<div class='row'>"+
						"<div id='error' class='alert alert-danger'>"+
							"You can select only one column at a time!"+
						"</div>"+
					"</div>");
			}
			else {
				//Remove any previous error messages
				$('#error').remove();

				updateTimes(start[1],end[1]);

				schedule_start = parseInt($('input[name=schedule-start]').val(),10);
				schedule_end = parseInt($('input[name=schedule-end]').val(),10);
				$( "#slider-range" ).slider({
					range: true,
					min: schedule_start,
					max: schedule_end,
					step: 50,
					values: [ start[1], end[1] ],
					slide: function( event, ui ) {
						start = ui.values[ 0 ];
						end = ui.values[ 1 ];
						updateTimes(start,end);
					}
				});

				$('.modal').modal();
			}
		},
	});
});

function updateTimes(start,end){
	$( "#times" ).text( convertNumberToTime(start) + " - " + convertNumberToTime(end) );
	$( "input[name='start']" ).val(start);
	$( "input[name='end']" ).val(end);
}