<?php

class Shift extends Eloquent {

    protected $table = 'shifts';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'schedule_id', 'date', 'start', 'end');

    public function TA()
    {
    	return $this->belongsTo('TA','ta_id')->first();
    }

    public static function free($start, $end = null)
    {
        if ($end == null)
            return Shift::where('ta_id','=',null)
        		->where("date",">",$start)->get();
        else return Shift::where('ta_id','=',null)
                ->whereBetween('date', array($start, $end))->get();
    }

}