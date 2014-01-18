<?php

class AdminAvailabilityExportController extends AdminController {

	public function postIndex(){

		header('Content-Description: File Transfer');

		$day = Input::get('day');

		if ($day == "All")
		{
			header('Content-Type: application/zip');

			$days = array(
        			"Sunday",
        			"Monday",
        			"Tuesday",
        			"Wednesday",
        			"Thursday",
        			"Friday",
        			"Saturday"
        		);

			$zipname = date("F_Y")."_".$day;
			$zip = new ZipArchive;
			$zip->open($zipname, ZipArchive::CREATE);
			foreach ($days as $day) {
				$zip->addFromString(date("F_Y")."_".$day.'.csv', $this->generateCSV($day));
			}
			$zip->close();

			header('Content-disposition: attachment; filename='.$zipname.'.zip');
			header('Content-Length: ' . filesize($zipname));
			readfile($zipname);
		}
		else
		{
			header('Content-type: text/plain');
			header('Content-Disposition: attachment; filename='.date("F_Y")."_".$day.".csv");
			echo $this->generateCSV($day);
		}
	}


	//Method to generate CSV for a certain day
	private function generateCSV($day)
	{
		$data = array();

		$tas = TA::active();

		foreach ($tas as $ta) {
			$data[$ta->id] = array();
		}

		$availabilities = Availability::day($day);

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
		
		return $csv;
	}
}