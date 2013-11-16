<?php

class TA extends Eloquent {

    protected $table = 'ta';

    public function user()
    {
    	return $this->belongsTo('User');
    }

    public function availability()
    {
    	return $this->hasMany('availability');
    }
    
}