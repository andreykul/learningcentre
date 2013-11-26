<?php

class AdminAvailabilityDownloadController extends AdminController {

	public function postIndex(){
		$day = Input::get('day');
		$availabilities = Availability::day($day);

		$data = array();

		foreach ($availabilities as $availability) {
			for ($i=$availability->start; $i < $availability->end; $i+=50) { 
				$data[$availability->ta_id][$i] = $availability->prefered;
			}
		}

		$csv = ",";
		foreach ($data as $ta_id => $times) {
			$ta = TA::find($ta_id);
			$csv .= $ta->name.",";
		}
		$csv .= "\n";

		$start = Time::toNumber(Settings::get('availability_start_hour')->value);
		$end = Time::toNumber(Settings::get('availability_end_hour')->value);

		for ($i=$start; $i < $end; $i+=50) { 
			$csv .= Number::toTime($i).",";
			foreach ($data as $ta_id => $times) {
				if (isset($times[$i]))
					$csv .= ($times[$i]+1).",";
				else $csv .= '0,';
			}
			$csv .= "\n";
		}

		header('Content-Description: File Transfer');
    	header('Content-type: text/plain');
    	header('Content-Disposition: attachment; filename='.date("F_Y")."_".$day.".csv");
		
		echo $csv;
	}
}