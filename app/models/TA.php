<?php

class TA extends Eloquent {

	protected $table = 'ta';

	protected $fillable = array('user_id','name');

	public function user()
	{
		return $this->belongsTo('User','user_id')->first();
	}

	public function availability($day = null)
	{
		if ($day == null)
			return $this->hasMany('Availability','ta_id')->get();
		else return $this->hasMany('Availability','ta_id')
					->where('day','=',$day)
					->get();
	}

	public function timesheets($semester,$year,$order = 'desc')
	{
		switch ($semester)
		{
			case "Winter":
				$start_date = "$year-01-01";
				$end_date = "$year-04-30";
				break;
			case "Summer":
				$start_date = "$year-05-01";
				$end_date = "$year-08-31";
				break;
			case "Fall":
				$start_date = "$year-09-01";
				$end_date = "$year-12-31";
				break;
			default:
				break;
		}

		return $this->hasMany('Timesheet', 'ta_id')
				->whereBetween('week',array($start_date,$end_date))
				->orderBy('week',$order)
				->get();
	}

	public function bids()
	{
		return $this->hasMany('ShiftBid','ta_id')->get();
	}    

	public function shifts($start, $end = null, $order = "asc")
	{
		if ($end == null)
			return $this->hasMany('Shift','ta_id')
					->where("date",">",$start)
					->orderBy('date', $order)
					->orderBy('start', $order)
					->get();
		else
		{
			return $this->hasMany('Shift','ta_id')
				->whereBetween('date', array($start, $end))
				->orderBy('date', $order)
				->orderBy('start', $order)
				->get();
		}
	}

	public function knowledge()
	{
		return $this->hasMany('CourseKnowledge','ta_id')->get();
	}
 
	public static function active()
	{
		return TA::where("active",'=',1)->get();
	}   
}   