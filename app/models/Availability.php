<?php

class Availability extends Eloquent {

    protected $table = 'availability';

    public function TA(){
    	return $this->belongsTo('TA', 'ta_id')->first();
    }
    
}