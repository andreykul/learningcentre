<?php

class TaAvailabilityController extends TaController {

	public function getAvailability(){
		$ta = Auth::user()->TA();
		$hours = $ta->availability();

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
		
		foreach ($hours as $hour){
			for ($i=$hour->start; $i < $hour->end; $i+=50){
				$week[$hour->day][$i] = $hour->prefered;
			}
		}

		$this->navbar['Availability']['active'] = true;

		return View::make('ta/availability')
					->with('user', $this->user)
                    ->with('navbar',$this->navbar)
                    ->with('days', $days)
					->with('week', $week)
					->with('time', $time)
					->with('locked', Settings::get('availability_locked')->value);
	}

	public function postAvailability()
	{
		$locked = Settings::get('availability_locked');

		//Check if Availability changes allowed
		if ( $locked->value == false ) 
		{
			$hours = Input::all();

			unset($hours['_token']);

			//Sort the times by value
			foreach ($hours as $day => $times)
			{
				ksort($times);
				$hours[$day] = $times;
			}

			//New availability
			$new_availability = array();

			//Loops through all reported days
			foreach ($hours as $day => $times) {
				//Loop through all times for each day
				foreach ($times as $time => $prefered)
				{
					//Check if already inside of an interval
					if (isset($interval))
					{
						//Check if still in the same interval by preference and consecutive time
						if ( $interval['prefered'] == $prefered && $interval['end'] == $time)
							$interval['end'] = $time+50;
						//Otherwise new interval
						else
						{
							$new_availability[] = $interval;
							$interval = array("day" => $day, "start" => $time, "end" => $time+50, "prefered" => $prefered);
						}
					}
					//Create new interval if one doesn't exist
					else $interval = array("day" => $day, "start" => $time, "end" => $time+50, "prefered" => $prefered);
				}
				$new_availability[] = $interval;
				unset($interval);
			}

			//Find previous Availability
			$old_availability = Auth::user()->TA()->availability();

			//Delete all previous Availability
			foreach ($old_availability as $old)
				$old->delete();

			$ta = Auth::user()->TA();

			//Create new Availability
			foreach ($new_availability as $new){
				$new['ta_id'] = $ta->id;
				Availability::create($new);
			}

			//TA updated availability
			$ta->availability_updated_at = date('Y-m-d H:i:s');
			$ta->save();

			Session::flash('success', true);

			//Redirect back to the TA availability page
			return Redirect::to('ta/availability');
			
		}
	}
}