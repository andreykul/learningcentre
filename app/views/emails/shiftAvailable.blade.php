<html>
	<body>
		<p>Hello {{ $name }}, </p>
		<br>
		<p>There is a shift available from {{ Number::toTime($shift->start) }} to {{ Number::toTime($shift->end) }} on {{ date('l', strtotime($shift->date)) }}, {{ date("F jS",strtotime($shift->date)) }}. </p>
		<br>
		<p>To cover the shift {{ link_to("ta/shifts?week_start=$week_start", "Click Here") }}</p>
		<br>
		<p>Thanks,</p>
		<p>Learning Centre Administration</p>
	</body>
</html>