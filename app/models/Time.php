<?php 

class Time {

	public static function ToNumber($time)
	{
		$time = explode(':', $time);
		unset($time[2]);
		$time[1] = $time[1]/60*100;
		$time[1] = str_pad($time[1],2,"0", STR_PAD_LEFT);
		$time = implode('', $time);
		return intval($time);
	}
}