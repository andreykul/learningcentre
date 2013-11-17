<?php

class TA extends Eloquent {

    protected $table = 'ta';

    public function user()
    {
    	return $this->belongsTo('User','user_id')->first();
    }

    public function availability()
    {
    	return $this->hasMany('Availability','ta_id')->get();
    }
    
}