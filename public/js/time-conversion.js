function convertNumberToTime(number)
{
	hour = Math.floor(number/100);
	minutes = Math.round(number%100/100*60);
	if (minutes< 10)
		minutes = "0" + minutes;

	time = [hour, minutes];
	time = time.join(':');

	return time;
}

function convertTimeToNumber(time)
{
	time = time.split(":");
	time[1] = Math.round(time[1]/60*100);
	if(time[1] < 10)
		time[1] = "0"+time[1];

	time = time.join('');

	time = parseInt(time,10);

	return time;
}