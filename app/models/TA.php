<?php

class TA extends Eloquent {

    protected $table = 'ta';

    protected $fillable = array('user_id','name');

    public function user()
    {
    	return $this->belongsTo('User','user_id')->first();
    }

    public function availability()
    {
    	return $this->hasMany('Availability','ta_id')->get();
    }

    public function timesheets()
    {
        return $this->hasMany('Timesheet', 'ta_id')->get();
    }

    public function bids()
    {
        return $this->hasMany('ShiftBid','ta_id')->get();
    }    

    public function shifts($start, $end = null)
    {
        if ($end == null)
            return $this->hasMany('Shift','ta_id')
                    ->where("date",">",$start)->get();
        else
        {
            return $this->hasMany('Shift','ta_id')
                ->whereBetween('date', array($start, $end))->get();
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