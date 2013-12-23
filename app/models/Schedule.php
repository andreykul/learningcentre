<?php

class Schedule extends Eloquent {

    protected $table = 'schedule';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'day', 'start', 'end');

    public static function day($day)
    {
    	return Schedule::where('day','=',$day)->get();
    }

    public function TA()
    {
    	return $this->belongsTo('TA', 'ta_id')->first();
    }
}