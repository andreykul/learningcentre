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
		$start = $this->convertTimeToNumber($start);
		$time['start'] = $start;

		$end = Settings::get("availability_end_hour")->value;
		$end = $this->convertTimeToNumber($end);
		$time['end'] = $end;
		
		foreach ($hours as $hour){
			$start_time = $hour->start;
			$start_time = $this->convertTimeToNumber($start_time);

			$end_time = $hour->end;
			$end_time = $this->convertTimeToNumber($end_time);

			for ($i=$start_time; $i < $end_time; $i+=50){
				$week[$hour->day][$i] = $hour->preffered;
			}

		}

		$this->navbar['Availability']['active'] = true;

		return View::make('ta/availability')
					->with('user', $this->user)
                    ->with('navbar',$this->navbar)
                    ->with('days', $days)
					->with('week', $week)
					->with('time', $time);
	}

	// Private methods

	private function convertTimeToNumber($time)
	{
		$time = explode(':', $time);
		unset($time[2]);
		$time[1] = $time[1]/60*100;
		$time[1] = str_pad($time[1],2,"0", STR_PAD_LEFT);
		$time = implode('', $time);
		return intval($time);
	}

}