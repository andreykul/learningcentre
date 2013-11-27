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
 
    public static function active()
    {
        return TA::where("active",'=',1)->get();
    }   
}