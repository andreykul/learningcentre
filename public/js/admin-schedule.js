
$(function(){

	var selection_end = [0,0];
	$( "#selectable" ).selectable({
		filter: "td",
		selected: function(event, ui){
			if ( $(ui.selected).hasClass('warning') || $(ui.selected).hasClass('success')){
				$(ui.selected).toggleClass('info');

				if ( $(ui.selected).hasClass('info') )
					$(ui.selected).children('input').val(true);
				else $(ui.selected).children('input').val(false);
			}
				
		}
	});
});
