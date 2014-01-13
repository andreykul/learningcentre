<?php

class TaTimesheetController extends TaController {

	public function postIndex()
	{
		$timesheet = Input::except('_token');

		foreach ($timesheet as $key => $value) {
			if (gettype($value) == "array"){
				$total_time = 0;
				foreach ($value as $time)
					$total_time += $time;

				$timesheet[$key] = $total_time;
			}
		}

		$timesheet['ta_id'] = Auth::user()->TA()->id;

		Timesheet::create($timesheet);

		Session::flash('success',"Time sheet submitted!");
		return Redirect::to('ta/hours');
	}
}