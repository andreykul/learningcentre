<?php

class AdminAvailabilityImportController extends AdminController {

	public function postIndex()
	{
		if (Input::has('csv'))
		{
			$day = Input::get('day');
			$csv = Input::file('csv');

			$parsed_csv = $this->parseCSV($csv);

			$new_availability = array();

			//Loops through all reported days
			foreach ($parsed_csv as $name => $times) {
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
							$new_availability[$name][] = $interval;
							$interval = array("day" => $day, "start" => $time, "end" => $time+50, "prefered" => $prefered);
						}
					}
					//Create new interval if one doesn't exist
					else $interval = array("day" => $day, "start" => $time, "end" => $time+50, "prefered" => $prefered);
				}
				$new_availability[$name][] = $interval;
				unset($interval);
			}

			$missing_tas = array();

			foreach ($new_availability as $ta_name => $availabilities) {
				$ta = TA::where('name','=',$ta_name)->first();
				if ($ta)
				{
					//Find previous Availability
					$old_availability = $ta->availability($day);

					//Delete all previous Availability
					foreach ($old_availability as $old)
						$old->delete();

					foreach ($availabilities as $availability) {
						$availability['ta_id'] = $ta->id;
						Availability::create($availability);
					}
				}
				else $missing_tas[] = $ta_name;
			}

			if ( count($missing_tas) == 0 )
				Session::flash('success', "Availabiltiy has been imported!");
			else Session::flash('warning', "Availabiltiy has been imported, but ".implode(',', $missing_tas). (count($missing_tas) == 1?" is ":" are ") ."missing in application!");

			//$times = parseCSV($);
		}
		else Session::flash('fail', "File has not been provided for import!");

		return Redirect::to('admin/availability');
	}


	//Method to parse CSV into availabilities
	private function parseCSV($csv)
	{
		$tas = array();

		if (($handle = fopen($csv->getRealPath(), "r")) !== FALSE)
		{
			if (($ta_names = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
				foreach ($ta_names as $name)
					if (! empty($name))
						$tas[$name] = array();
			}

			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
				$time = $data[0];

				$i = 1;
				foreach (array_keys($tas) as $name) {
					if ($data[$i] != 0 )
						$tas[$name][Time::toNumber($time)] = $data[$i] - 1;
					$i++;
				}
					
			}
			fclose($handle);
		}

		return $tas;
	}
}