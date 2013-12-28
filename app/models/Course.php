<?php

class Course extends Eloquent {

    protected $table = 'courses';

    public $timestamps = false;

    protected $fillable = array('prefix', 'number', 'name');

    public function TAs()
    {
    	return $this->hasMany('CourseKnowledge', 'course_id')->get();
    }
}