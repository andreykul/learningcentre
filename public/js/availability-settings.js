$(function() {

	//$( ".locked" ).buttonset();

	hours = $("#hours").text();
	hours = hours.split(" - ");

	start_hour = hours[0];
	end_hour = hours[1];

	start_hour = convertTimeToNumber(start_hour);

	end_hour = convertTimeToNumber(end_hour);


	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: 2400,
		step: 50,
		values: [ start_hour, end_hour ],
		slide: function( event, ui ) {
			start_time = convertNumberToTime(ui.values[ 0 ]);
			end_time = convertNumberToTime(ui.values[ 1 ]);
			$( "#hours" ).text( start_time + " - " + end_time );
			$( "input[name='availability_start_hour']" ).val(start_time);
			$( "input[name='availability_end_hour']" ).val(end_time);
		}
	});

});

function convertNumberToTime(number)
{
	hour = Math.floor(number/100);
	minutes = number%100/100*60;
	if (minutes< 10)
		minutes = "0" + minutes;

	time = [hour, minutes];
	time = time.join(':');

	return time;
}

function convertTimeToNumber(time)
{
	time = time.split(":");
	time[1] = time[1]/60*100;
	if(time[1] < 10)
		time[1] = "0"+time[1];

	time = time.join('');

	time = parseInt(time,10);

	return time;
}