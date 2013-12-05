<?php

class Shift extends Eloquent {

    protected $table = 'shifts';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'schedule_id', 'date', 'start', 'end');

    public function TA()
    {
    	return $this->belongsTo('TA','ta_id')->first();
    }

}