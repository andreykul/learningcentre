
$(function(){

	var selection_end = [0,0];
	$( "#selectable" ).selectable({
		filter: "td",
		selected: function(event, ui){
			id = ui.selected.id.split('-')[0];
			if ( $(ui.selected).hasClass('info') ){
				$(ui.selected).toggleClass('info');
				$(ui.selected).children('input').val(0);
				current_hours = parseFloat($('#'+id+'-current-hours').text(), 10) - 0.5;
				$('#'+id+'-current-hours').text(current_hours);
			}
			else /*if ( $(ui.selected).hasClass('warning') || $(ui.selected).hasClass('success'))*/
			{
				id = ui.selected.id.split('-')[0];

				wanted_hours = parseFloat($('#'+id+'-wanted-hours').text(), 10);
				current_hours = parseFloat($('#'+id+'-current-hours').text(), 10) + 0.5;

				// if (current_hours <= wanted_hours){
					$('#'+id+'-current-hours').text(current_hours);

					$(ui.selected).toggleClass('info');
					$(ui.selected).children('input').val(1);
				// }
			}
		}
	});
});
