$(function(){
	$( "#selectable" ).selectable({
		filter: "td",
		start: function(event, ui){
			console.log(event.toElement.id);
		},
		stop: function(event, ui){
			console.log(event.toElement.id);
		},
		selected: function(event, ui){
			$(ui.selected).toggleClass('info');
		}
	});
});