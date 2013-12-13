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

		$this->navbar['Schedule']['active'] = true;

		return View::make('admin/schedule')
					->with('user', $this->user)
					->with('navbar', $this->navbar)
					->with('days', $days)
					->with('week', $week)
					->with('time', $time);
	}
}