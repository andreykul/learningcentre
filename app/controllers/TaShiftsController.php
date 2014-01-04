<?php

class TaShiftsController extends TaController {
	
	public function __construct()
	{
		parent::__construct();
		if (isset($this->user))
			$this->beforeFilter('active:'.$this->user['active']);
	}

	//Method to view shifts for a certain week
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

		//Check if asked for a different week from the GET request
		if (Input::has('week_start'))
			$week_start = Input::get('week_start');
		else 
		{
			$week_start = time() - (date('w') * 24 * 60 * 60);
			$week_start = date('Y-m-d', $week_start);
		}

		//Compute end of week which is start week plus 6 days
		$week_end = strtotime($week_start) + (6 * 24 * 60 * 60);
		$week_end = date('Y-m-d', $week_end);
		
		//Get all shifts for the TA from start of the week to the end
		$shifts = Auth::user()->TA()->shifts($week_start, $week_end);

		//Get the defined start time of the LC
		$start = Settings::get("availability_start_hour")->value;
		$start = Time::ToNumber($start);
		$time['start'] = $start;

		//Get the defined start time of the LC
		$end = Settings::get("availability_end_hour")->value;
		$end = Time::ToNumber($end);
		$time['end'] = $end;

		//Set up the data of shifts for the view to use
		foreach ($shifts as $shift){
			$day = date("l",strtotime($shift->date));
			//First cell contains all the data for the shift
			$week[$day][$shift->start]['id'] = $shift->id;

			$old = $shift->date < date("Y-m-d", strtotime('today'));
			$passed = $shift->date == date("Y-m-d", strtotime('today')) && $shift->start < Time::toNumber(date("G:i"));
			if( $old || $passed )
				$week[$day][$shift->start]['old'] = true;
			else $week[$day][$shift->start]['old'] = false;

			$week[$day][$shift->start]['mine'] = true;
			$week[$day][$shift->start]['length'] = ($shift->end - $shift->start) / 50;
			//Rest of the cells will be skipped
			for ($i=$shift->start+50; $i < $shift->end; $i+=50)
				$week[$day][$i]['skip'] = 1;
		}

		//Set up the data of free shifts for the view to use, same as the regular shifts
		$shifts = Shift::free(( $week_start > date('Y-m-d')? $week_start : date('Y-m-d') ), $week_end);
		foreach ($shifts as $shift){
			$day = date("l",strtotime($shift->date));
			if ($shift->date != date("Y-m-d") || $shift->start > Time::toNumber(date("G:i")) )
				for ($i=$shift->start; $i < $shift->end; $i+=50){
					if ( ! isset($week[$day][$i]) ){
						$week[$day][$i]['id'] = $shift->id;
						$week[$day][$i]['mine'] = false;
						if (ShiftBid::shift($shift->id, Auth::user()->TA()->id))
							$week[$day][$i]['bid'] = true;
						else $week[$day][$i]['bid'] = false;
						$week[$day][$i]['length'] = ($shift->end - $i) / 50;
						$shift_start = $i;
						for ($i=$i+50; $i < $shift->end; $i+=50)
							if (! isset($week[$day][$i]))
								$week[$day][$i]['skip'] = 1;
							else 
							{
								$week[$day][$shift_start]['length'] = ($i - $shift->start) / 50;
								break;
							}
					}
				}
		}

		//Set the page selected to Shifts
		$this->navbar['Shifts']['active'] = true;

		return View::make('ta/shifts')
					->with('user', $this->user)
					->with('navbar',$this->navbar)
					->with('days', $days)
					->with('week', $week)
					->with('time', $time)
					->with('week_start', $week_start);
	}

	//Method to drop a shift
	public function deleteIndex()
	{
		$shift = Shift::find(Input::get('shift_id'));

		$ta_id = Auth::user()->TA()->id;

		//The week start for the shift
		$week_start = strtotime($shift->date) - (date('w', strtotime($shift->date)) * 24 * 60 * 60);
		$week_start = date('Y-m-d', $week_start);

		//make sure the shift belongs to the TA
		if ($shift->ta_id == $ta_id )
		{
			$shift->ta_id = null;
			$shift->save();

			Session::flash('success', "Shift on ".date('l, F jS',strtotime($shift->date))." has been dropped.");

			$tas = TA::active();

			//Send email to all active TAs
			foreach ($tas as $ta) {
				$email = $ta->user()->email;

				//No need to send email to TA who dropped the shift
				if ($ta_id != $ta->id)
				{
					Mail::send('emails.shiftAvailable', array('name' => $ta->name, 'shift'=>$shift, 'week_start'=>$week_start), function($message) use ($ta, $email)
					{
						$message->to($email, $ta->name )->subject('Shift Available!');
					});
				}
			}
		}
		//error message, Shift does not belong to the TA
		else Session::flash('fail', "Shift does not belong to you.");

		return Redirect::to('ta/shifts?week_start='.$week_start);
	}

	//Method to make a bid for a shift
	public function putIndex()
	{
		$bid = Input::except('_token','_method');

		$shift = Shift::find($bid['shift_id']);

		//The week start for the shift
		$week_start = strtotime($shift->date) - (date('w', strtotime($shift->date)) * 24 * 60 * 60);
		$week_start = date('Y-m-d', $week_start);
		
		//Can cover the whole shift
		if ( $shift->start == $bid['start'] && $shift->end == $bid['end'] )
		{
			$overlap = $this->checkOverlap($bid);
			if (! $overlap )
			{
				$bid['date'] = $shift->date;
				if ($old_shift = $this->checkCover($bid))
					Shift::destroy($old_shift->id);

				$shift->ta_id = $bid['ta_id'];
				$shift->save();

				//Remove all bids for the shift
				$this->clearBids($shift->id);

				Session::flash('success', "Shift has been added to your schedule.");
			}
			else Session::flash('fail', "Bid overlaps with existing shift.");
		}
		//Can't cover the entire shift, updating exsisting bid
		else if ( $my_bid = ShiftBid::shift($bid['shift_id'],$bid['ta_id']) )
		{
			$overlap = $this->checkOverlap($bid);
			if (! $overlap)
			{
				$my_bid->start = $bid['start'];
				$my_bid->end = $bid['end'];
				$my_bid->save();

				//Vatiable to store the total hours of combined bids
				$total_bid = new stdClass();
				$total_bid->start = $my_bid->start;
				$total_bid->end = $my_bid->end;

				//Array to store all chosen bids
				$chosen_bids = array($my_bid);
				$shift_bids = ShiftBid::shift($my_bid->shift_id);

				//Two flags for iteration
				$prev_chosen = -1;
				$stop = false;

				//Keep iterating until found enough bids or until not matching bids found
				while ( $prev_chosen != count($chosen_bids) && !$stop )
				{
					$prev_chosen = count($chosen_bids);
					foreach ($shift_bids as $bid) {
						if ($bid->end == $total_bid->start || $bid->start == $total_bid->end)
						{
							$chosen_bids[] = $bid;
							$total_bid->start = min($total_bid->start, $bid->start);
							$total_bid->end = max($total_bid->end, $bid->end);
						}
					}

					if ($total_bid->start == $shift->start && $total_bid->end == $shift->end)
					{
						$stop = true;
						foreach ($chosen_bids as $bid) {
							unset($bid->shift_id);
							$bid->date = $shift->date;

							Shift::create($bid->toArray());
							
							if ($shift = $this->checkCover($bid))
								Shift::destroy($shift->id);
						}

						//Remove all bids for the shift
						$this->clearBids($shift->id);

						//Remove the old shift
						Shift::destroy($shift->id);

						Session::flash('success', "Shift has been added to your schedule.");
					}
					else Session::flash('success', "Bid has been changed.");
				}
			}
			else Session::flash('fail', "Bid overlaps with existing shift.");
		}
		//Can't cover the entire shift, new bid
		else
		{
			//No empty bids
			if ($bid['start'] != $bid['end'])
			{
				$overlap = $this->checkOverlap($bid);
				if (! $overlap ){
					ShiftBid::create($bid);
					Session::flash('success', "Bid has been added.");
				}
				else Session::flash('fail', "Bid overlaps with existing shift.");
			}
			else Session::flash('fail', "No empty bids allowed.");
		}

		return Redirect::to('ta/shifts?week_start='.$week_start);
	}

	//Get the shift details of a shift with ID as $id
	public function getShift($id)
	{
		$shift = Shift::find($id);
		return $shift->toJson();
	}

	//Get all the bids for a shift with ID as $id
	public function getBids($id)
	{
		$shift_bids = ShiftBid::shift($id);
		return $shift_bids->toJson();
	}



	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * //
	//								Private									   //
	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * //


	private function checkOverlap($bid)
	{
		$ta_id = $bid['ta_id'];
		$shift = Shift::find($bid['shift_id']);

		$overlap_shifts = TA::find($ta_id)->shifts($shift->date,$shift->date);

		//No shifts that day, no overlap
		if ( count($overlap_shifts) == 0 )
			return false;
		//Need to check each shift
		else
		{
			foreach ($overlap_shifts as $shift)
				if ( ($shift->start < $bid['start'] && $bid['start'] < $shift->end ) || ($shift->start < $bid['end'] && $bid['end'] < $shift->end ) )
					return true;
		}
			
		return false;
	}

	private function checkCover($bid)
	{
		$ta_id = $bid['ta_id'];

		$shifts = TA::find($ta_id)->shifts($bid['date'],$bid['date']);

		//No shifts that day, no overlap
		if ( count($shifts) == 0 )
			return false;
		//Need to check each shift
		else {
			foreach ($shifts as $shift)
				if ( $bid['start'] <= $shift->start && $shift->end <= $bid['end'])
					return $shift;
		}
			
		return false;
	}

	private function clearBids($shift_id)
	{
		$bids = ShiftBid::shift($shift_id);
		foreach ($bids as $bid)
			ShiftBid::destroy($bid->id);
	}
}