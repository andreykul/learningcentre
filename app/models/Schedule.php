<?php

class Schedule extends Eloquent {

    protected $table = 'schedule';

    public function TA(){
    	return $this->belongsTo('ta');
    }
    
}