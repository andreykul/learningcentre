<?php 

class Number {

	public static function ToTime($number)
	{
		$hours = intval($number/100);
		$hours = str_pad($hours,2,"0", STR_PAD_LEFT);
		$minutes = $number%100/100*60;
		$minutes = str_pad($minutes,2,"0", STR_PAD_LEFT);
		$time = implode(':', array($hours,$minutes));
		return $time;
	}
}