<?php

class AdminScheduleController extends AdminController {

	public function getIndex()
	{
		$week = array(
					"Sunday" => array(),
	    			"Monday" => array(),
	    			"Tuesday" => array(),
	    			"Wednesday" => array(),
	    			"Thursday" => array(),
	    			"Friday" => array(),
	    			"Saturday" => array()
				);

		$days = array(
        			"Sunday",
        			"Monday",
        			"Tuesday",
        			"Wednesday",
        			"Thursday",
        			"Friday",
        			"Saturday"
        		);

		$start = Settings::get("availability_start_hour")->value;
		$start = Time::ToNumber($start);
		$time['start'] = $start;

		$end = Settings::get("availability_end_hour")->value;
		$end = Time::ToNumber($end);
		$time['end'] = $end;

		$availabilities = Availability::all();
		$max_available = 1;

		foreach ($availabilities as $availability){
			for ($i=$availability->start; $i < $availability->end; $i+=50){
				if (isset($week[$availability->day][$i])){
					$week[$availability->day][$i] ++;
					if ( $max_available < $week[$availability->day][$i] )
						$max_available = $week[$availability->day][$i];
				}
				else $week[$availability->day][$i] = 1;
			}
		}

		$this->navbar['Schedule']['active'] = true;

		return View::make('admin/schedule')
					->with('user', $this->user)
					->with('navbar', $this->navbar)
					->with('max',$max_available)
					->with('days', $days)
					->with('week', $week)
					->with('time', $time);
	}
}