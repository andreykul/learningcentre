$(function(){

	$('.shift-own').hover(function(){
		$(this).toggleClass('success');
		$(this).toggleClass('danger');
		$(this).toggleClass('text-danger');
		$(this).children('span').show();
	},function(){
		$(this).toggleClass('success');
		$(this).toggleClass('danger');
		$(this).toggleClass('text-danger');
		$(this).children('span').hide();
	});

	$('.shift-free').hover(function(){
		$(this).toggleClass('warning');
		$(this).toggleClass('info');
		$(this).children('span').show();
	},function(){
		$(this).toggleClass('warning');
		$(this).toggleClass('info');
		$(this).children('span').hide();
	});

	$('.shift-bid').hover(function(){
		$(this).children('span').show();
	},function(){
		$(this).children('span').hide();
	});

	$('.shift-own').click(function(){
		$(this).children('form').submit();
	});

	$('.shift-free, .shift-bid').click(function(){
		shift_id = $(this).children('input').val();
		$('.modal input[name=shift_id]').val(shift_id);

		callShift(shift_id);

		$('.modal').modal();
	});
});

function callShift(shift_id){
	$.ajax({
		url: "shifts/shift/"+shift_id,
		context: $('.modal-body')
	}).done(function(shift) {
		shift = JSON.parse(shift);
		$( "#full-shift" ).text( convertNumberToTime(shift.start) + " - " + convertNumberToTime(shift.end) );
		updateTimes(shift.start,shift.end);
		$( "#slider-range" ).slider({
			range: true,
			min: parseInt(shift.start,10),
			max: parseInt(shift.end,10),
			step: 50,
			values: [ parseInt(shift.start,10), parseInt(shift.end,10) ],
			slide: function( event, ui ) {
				start = Math.round(ui.values[ 0 ]);
				end = Math.round(ui.values[ 1 ]);
				updateTimes(start,end);
			}
		});

		callBids(shift_id);
	});
}

function updateTimes(start,end){
	$( "#times" ).text( convertNumberToTime(start) + " - " + convertNumberToTime(end) );
	$( "input[name='start']" ).val(start);
	$( "input[name='end']" ).val(end);
}

function callBids(shift_id){
	$.ajax({
		url: "shifts/bids/"+shift_id,
		context: $('.other-bids fieldset')
	}).done(function(bids) {
		bids = JSON.parse(bids);

		ta_id = $('input[name=ta_id]').val();
		my_bid = _.findWhere(bids, {ta_id: ta_id});

		$( this ).parent().children('p').remove();

		if(my_bid){
			$('.my-bid legend').text("Change Bid");
			updateTimes(my_bid.start, my_bid.end);
			$( "#slider-range" ).slider( "option", "values", [my_bid.start,my_bid.end] );
		}
		else $('.my-bid legend').text("Add Bid");

		if ( bids.length && !(bids.length == 1 && _.first(bids).id == my_bid.id) ){
			//Display fieldset with table
			$( this ).show();
			//Clear previous bids if any
			body = $( this ).children('.table').children('tbody');
			body.children('tr').remove();

			_.each(bids,function(bid){
				if (bid.ta_id != ta_id){
					body.append("<tr>" +
							"<td class='text-center'>"+ convertNumberToTime(bid.start) +"</td>" +
							"<td class='text-center'>"+ convertNumberToTime(bid.end) +"</td>" +
							"</tr>");
				}
			});
		}
		else $( this ).hide().after("<p>There are no other bids yet!</p>");
	});
}