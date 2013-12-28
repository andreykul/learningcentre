<?php

class Course extends Eloquent {

    protected $table = 'course_knowledge';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'course_id', 'knowledge');

    public function TA()
    {
    	return $this->belongsTo('TA', 'ta_id')->first();
    }

    public function Course()
    {
    	return $this->belongsTo('Course','course_id')->first();
    }
}