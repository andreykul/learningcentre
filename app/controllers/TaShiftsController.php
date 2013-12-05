<?php

class TaShiftsController extends TaController {
	
	public function __construct()
	{
		parent::__construct();
		if (isset($this->user))
			$this->beforeFilter('active:'.$this->user['active']);
	}

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

		if (Input::has('week_start'))
			$week_start = Input::get('week_start');
		else 
		{
			$week_start = time() - (date('w') * 24 * 60 * 60);
			$week_start = date('Y-m-d', $week_start);
		}

		$week_end = strtotime($week_start) + (6 * 24 * 60 * 60);
        $week_end = date('Y-m-d', $week_end);
		
		$shifts = Auth::user()->TA()->shifts($week_start, $week_end);

		$start = Settings::get("availability_start_hour")->value;
		$start = Time::ToNumber($start);
		$time['start'] = $start;

		$end = Settings::get("availability_end_hour")->value;
		$end = Time::ToNumber($end);
		$time['end'] = $end;

		foreach ($shifts as $shift){
			for ($i=$shift->start; $i < $shift->end; $i+=50){
				$day = date("l",strtotime($shift->date));
				$week[$day][$i] = 1;
			}
		}

        $this->navbar['Shifts']['active'] = true;

        return View::make('ta/shifts')
        			->with('user', $this->user)
                    ->with('navbar',$this->navbar)
                    ->with('days', $days)
					->with('week', $week)
					->with('time', $time)
					->with('week_start', $week_start);
	}
}