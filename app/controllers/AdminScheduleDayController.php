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
}