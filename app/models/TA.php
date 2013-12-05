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

    public function shifts($week_start, $week_end = null)
    {
        if ($week_end == null)
            return $this->hasMany('Shift','ta_id')
                    ->where("date",">",$week_start)->get();
        else
        {
            return $this->hasMany('Shift','ta_id')
                ->whereBetween('date', array($week_start, $week_end))->get();
        }
    }
 
    public static function active()
    {
        return TA::where("active",'=',1)->get();
    }   
}   