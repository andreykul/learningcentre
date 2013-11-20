<?php

class Availability extends Eloquent {

    protected $table = 'availability';

    public $timestamps = false;

    protected $fillable = array('ta_id' ,'day', 'start', 'end', 'prefered');

    public function TA(){
    	return $this->belongsTo('TA', 'ta_id')->first();
    }
    
}