<?php

class AdminScheduleDayController extends AdminController {

	public function getIndex()
	{
		$day = Input::get('day');
		$start = Settings::get("availability_start_hour")->value;
		$start = Time::ToNumber($start);
		$time['start'] = $start;

		$end = Settings::get("availability_end_hour")->value;
		$end = Time::ToNumber($end);
		$time['end'] = $end;

		$availabilities = Availability::day($day);

		$tas = TA::active();

		$available = array();
		foreach ($availabilities as $availability)
			for ($i=$availability->start; $i < $availability->end; $i+=50)
				$available[$availability->ta_id][$i] = $availability->prefered;

		$this->navbar['Schedule']['active'] = true;

		return View::make('admin/schedule_day')
					->with('user', $this->user)
					->with('navbar', $this->navbar)
					->with('available',$available)
					->with('day',$day)
					->with('tas',$tas)
					->with('time', $time);
	}

	public function postIndex()
	{
		$day = Input::get('day');
		$tas = Input::except(array('_token','day'));

		$shifts = array();
		
		foreach ($tas as $ta_id => $times)
		{
			$start = null;
			$end;
			$ta_id = explode('-', $ta_id)[1];

			foreach ($times as $time => $value)
			{
				if ( $start != null )
				{
					if ($value == 0 || $time != $end )
					{
						$shifts[] = array('ta_id'=>$ta_id,'day'=>$day,'start'=>$start,'end'=>$end);
						$start = null;
					} 
				}

				if ( $value == 1 )
				{
					if ( $start == null )
						$start = $time;
					$end = $time+50;
				}
			}

			if ( $start != null )
				$shifts[] = array('ta_id'=>$ta_id,'day'=>$day,'start'=>$start,'end'=>$end);
		}

		foreach ($shifts as $shift){
			Schedule::create($shift);

			$ta = TA::find($shift['ta_id']);
			$ta->current_hours += ($shift['end'] - $shift['start']) / 50 / 2;
			$ta->save();
		}

		Session::flash('success', "$day's Schedule saved!");
		return Redirect::to('admin/schedule');
	}
}