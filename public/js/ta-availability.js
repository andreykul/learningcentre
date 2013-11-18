$(function() {

	var selection;

	changes = [];

	$('.availability').click(function(){
		selection = $(this).val();
	});

	$( "#selectable" ).selectable({
		filter: "td",
		selected: function(event, ui){
			item = $(ui.selected);
			if (item.hasClass("success"))
				availability = "success";
			else if (item.hasClass("warning"))
				availability = "warning";
			else availability = "";
			item.removeClass("success warning").addClass(selection);

			date = new Date();
			time = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
			changes.push({item: item, time: time, availability: availability });
		},
	});

	ctrlDown = false;

	CTRL = 17;
	COMMAND = 91;
	Z = 90;

	$( window ).keydown(function(event) {
		if (ctrlDown){
			if (event.which == Z && changes.length > 0){
				last = _.last(changes);

				last_changes = _.where(changes, {time: last.time});

				_.each(last_changes, function(change){
					change.item.removeClass("success warning").addClass(change.availability);
				});

				changes = _.difference(changes, last_changes);
			}
		}
		else if (event.which == COMMAND || event.which == CTRL)
			ctrlDown = true;
	});

	$( window ).keyup(function(event) {
		if (event.which == COMMAND || event.which == CTRL)
			ctrlDown = false;
	});
});