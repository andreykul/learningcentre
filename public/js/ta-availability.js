$(function() {

	var selection;

	//Changes array
	changes = [];

	//Change the availability to apply
	$('.availability').click(function(){
		selection = $(this).val();
	});

	//Make the table selectable
	$( "#selectable" ).selectable({
		filter: "td",
		selected: function(event, ui){
			//selected item
			item = $(ui.selected);

			//Store old availability
			if (item.hasClass("success"))
				availability = "success";
			else if (item.hasClass("warning"))
				availability = "warning";
			else availability = "";

			//Change the table and input
			change({item: item, availability: selection});

			//Construct a string for current time
			date = new Date();
			time = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();

			//Add the change to the changes array
			changes.push({item: item, time: time, availability: availability });
		},
	});

	//Boolean to keep track of Ctrl or Command being pressed
	ctrlDown = false;

	//Define constants
	CTRL = 17;
	COMMAND = 91;
	Z = 90;

	//Waiting for Ctrl+Z keyboard press
	$( window ).keydown(function(event) {
		//Check if Ctrl is pressed
		if (ctrlDown){
			//Check if there were any changes and Ctrl+Z is pressed
			if (event.which === Z && changes.length > 0)
				undoChanges();
		}
		//Check if Command or Ctrl were pressed
		else if (event.which === COMMAND || event.which === CTRL)
			ctrlDown = true;
	});

	//Ctrl or Command is unpressed
	$( window ).keyup(function(event) {
		if (event.which === COMMAND || event.which === CTRL)
			ctrlDown = false;
	});

	//Undo the last changes to the table
	function undoChanges(){
		//Get the last change made
		last = _.last(changes);

		//Based on its' time get the others
		last_changes = _.where(changes, {time: last.time});

		//Undo the changes for each change
		_.each(last_changes, function(interval){
			//Put previous class
			change(interval);
		});

		//Remove the last changes from the changes
		changes = _.difference(changes, last_changes);
	}

	function change(interval){
		interval.item.removeClass("success warning").addClass(interval.availability);

		//Get the name of the input to undo
		input_name = interval.item.attr('id').split('-');
		input_name = input_name[0]+"["+input_name[1]+"]";

		//Select the input in the DOM
		input = $( 'input[name="'+input_name+'"]' );

		//Undo the value
		var value = null;
		if (interval.availability === "success")
			value = 1;
		else if (interval.availability === "warning")
			value = 0;

		//Check if input exists in the DOM
		if (input.length){
			//Update value
			if (value !== null)
				input.val(value);
			//Remove input if Unavailable
			else input.remove();
		}
		//Add input if doesn't exist anymore
		else if (value !== null)
			$( 'input' ).last().after('<input name="'+input_name+'" type="hidden" value="'+value+'">');
	}
});
