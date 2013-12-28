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

		$shifts = Schedule::all();
		$assigned = array();
		foreach ($shifts as $shift) {
			for ($i=$shift->start; $i < $shift->end; $i+=50){
				$ta = $shift->TA();
				if(isset($ta))
					$assigned[$shift->day][$i][] = $ta->name;
			}
		}

		$this->navbar['Schedule']['active'] = true;

		return View::make('admin/schedule')
					->with('user', $this->user)
					->with('navbar', $this->navbar)
					->with('max',$max_available)
					->with('days', $days)
					->with('week', $week)
					->with('assigned',$assigned)
					->with('time', $time);
	}

	public function postIndex()
	{
		$dates = Input::except('_token');
		
		//Check dates
		//Start date must be at least today
		if ( date('Y-m-d',strtotime($dates['start_date'])) < date('Y-m-d') )
			$dates['start_date'] = date('Y-m-d');

		if ( date('Y-m-d',strtotime($dates['end_date'])) <= date('Y-m-d') || $dates['end_date'] == "")
		{
			Session::flash('fail',"Failed to publish! Bad End date!");
			return Redirect::to('admin/schedule');
		}

		//Erase all shifts in within the date range
		$shifts = Shift::between($dates['start_date'], $dates['end_date']);

		foreach ($shifts as $shift)
			$shift->delete();

		//Create new shifts
		$schedule = Schedule::all();

		foreach ($schedule as $shift) {
			$shift_date = new DateTime(date("Y-m-d", strtotime("this {$shift->day}")));
			while ( $shift_date->format('Y-m-d') <= $dates['end_date'] )
			{
				Shift::create(
					array(
						'ta_id' => $shift->ta_id,
						'date' => $shift_date->format('Y-m-d'),
						'start' => $shift->start,
						'end' => $shift->end
					)
				);

				$shift_date->modify("next {$shift->day}");
			}
		}

		Session::flash('success',"Schedule has been published!");
		return Redirect::to('admin/schedule');
	}

	public function deleteIndex()
	{
		$schedule = Schedule::all();

		foreach ($schedule as $shift)
			$shift->delete();

		$tas = TA::active();
		foreach ($tas as $ta) {
			$ta->current_hours = 0;
			$ta->save();
		}

		Session::flash('success', "Schedule has been reset!");
		return Redirect::to("admin/schedule");
	}
}