<?php

class TaHoursController extends TaController
{
	public function getIndex()
	{
		//A ton of work ...
		$ta = Auth::user()->TA();

		$this->navbar['Hours']['active'] = true;

		if (Input::has('year'))
			$year['now'] = Input::get('year');
		else $year['now'] = date('Y');
		
		if (Input::has('semester'))
			$semester['now'] = Input::get('semester');
		else
			$month = date('n');

		if (isset($semester['now']))
		{
			switch($semester['now'])
			{
				case "Winter":
					$semester['previous'] = "Fall";
					$semester['next'] = "Summer";
					$year['previous'] = $year['now'] - 1;
					$year['next'] = $year['now'];
					$first_week = new DateTime("1 January {$year['now']}");
					$last_week = new DateTime("30 April {$year['now']}");
					break;
				case "Summer":
					$semester['previous'] = "Winter";
					$semester['next'] = "Fall";
					$year['previous'] = $year['now'];
					$year['next'] = $year['now'];
					$first_week = new DateTime("1 May {$year['now']}");
					$last_week = new DateTime("31 August {$year['now']}");
					break;
				case "Fall":
					$semester['previous'] = "Summer";
					$semester['next'] = "Winter";
					$year['previous'] = $year['now'];
					$year['next'] = $year['now'] + 1;
					$first_week = new DateTime("1 September {$year['now']}");
					$last_week = new DateTime("31 December {$year['now']}");
					break;
				default:
					return Redirect::to('ta/hours');
			}
		}
		else
		{
			switch ($month)
			{
				case 1:
				case 2:
				case 3:
				case 4:
					$semester['previous'] = "Fall";
					$semester['now'] = "Winter";
					$semester['next'] = "Summer";
					$year['previous'] = $year['now'] - 1;
					$year['next'] = $year['now'];
					$first_week = new DateTime("1 January {$year['now']}");
					break;
				case 5:
				case 6:
				case 7:
				case 8:
					$semester['previous'] = "Winter";
					$semester['now'] = "Summer";
					$semester['next'] = "Fall";
					$year['previous'] = $year['now'];
					$year['next'] = $year['now'];
					$first_week = new DateTime("1 May {$year['now']}");
					break;
				case 9:
				case 10:
				case 11:
				case 12:
					$semester['previous'] = "Summer";
					$semester['now'] = "Fall";
					$semester['next'] = "Winter";
					$year['previous'] = $year['now'];
					$year['next'] = $year['now'] + 1;
					$first_week = new DateTime("1 September {$year['now']}");
					break;
				default:
					return Redirect::to('ta/hours');
			}
		}
		

		$first_week->modify('next Sunday');

		if (isset($last_week) && $last_week->format('Y-m-d') > date('Y-m-d'))
		{
			unset($last_week);

			//86400 = Milliseconds in a day
			$current_week = ceil((time() - $first_week->getTimestamp()) / (86400 * 7));
		}
		else if(isset($last_week))
			$current_week = ceil(($last_week->getTimestamp() - $first_week->getTimestamp()) / (86400 * 7));
		else $current_week = ceil((time() - $first_week->getTimestamp()) / (86400 * 7));

		if ($current_week < 0)
			return Redirect::to('ta/hours');

		$timesheets = $ta->timesheets($semester['now'],$year['now']);

		$hours = array(
			"worked" => 0,
			"additional" => 0,
			"total" => 0,
			"submitted" => 0,
			"approved" => 0
		);

		if (isset($last_week))
		{
			//Already NOT on a Saturday
			if ( $last_week->format('w') != 6 )
				$last_week->modify('last Saturday');
			$week_end = $last_week->format('Y-m-d');
			$last_week->modify('-6 day');
			$week_start = $last_week->format('Y-m-d');
		}
		else
		{
			$week_start = time() - (date('w') * 24 * 60 * 60);
			$week_start = date('Y-m-d', $week_start);

			$week_end = strtotime($week_start) + (6 * 24 * 60 * 60);
			$week_end = date('Y-m-d', $week_end);	
		}

		$shifts = $ta->shifts($first_week->format('Y-m-d'), $week_end);
		$shifts_total = array_fill(1, $current_week, 0);
		$shifts_per_week = array_fill(1, $current_week, array("shifts" => array()));

		foreach ($shifts as $shift) {
			$worked = ($shift->end - $shift->start) / 100;
			$week_number = ceil( (strtotime($shift->date) - $first_week->getTimestamp()) / (86400 * 7));
			$shifts_total[$week_number] += $worked;
			$shifts_per_week[$week_number]["shifts"][] = $shift;
			$hours['worked'] += $worked;
			$hours['total'] += $worked;
		}

		foreach ($timesheets as $timesheet) {
			$hours['additional'] += $timesheet->additional;
			$hours['total'] += $timesheet->additional;
			$hours['submitted'] += $timesheet->total;
			if ($timesheet->approved)
				$hours['approved'] += $timesheet->total;

			$week_number = ceil( (strtotime($timesheet->week) - $first_week->getTimestamp()) / (86400 * 7));
			$shifts_per_week[$week_number]['submitted'] = true;
			if (isset($timesheet->approved))
				$shifts_per_week[$week_number]['approved'] = $timesheet->approved;
			$shifts_per_week[$week_number]['additional'] = $timesheet->additional;
			$shifts_per_week[$week_number]['memo'] = $timesheet->memo;
		}
		
		// echo "<pre>";
		// print_r($shifts_per_week);
		// echo "</pre>";
		// exit();

		// //Override shifts to contain only last week's shifts
		// $shifts = $ta->shifts($week_start, $week_end);

		return View::make('ta/hours')
					->with('user', $this->user)
					->with('navbar',$this->navbar)
					->with('semester',$semester)
					->with('year',$year)
					->with('timesheets', $timesheets)
					->with('hours', $hours)
					->with('shifts_per_week', $shifts_per_week)
					->with('shifts_total',$shifts_total)
					->with('week_start',$week_start)
					->with('week_end',$week_end)
					->with('current_week',$current_week);
	}
}