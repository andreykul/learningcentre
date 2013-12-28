<?php

class Course extends Eloquent {

    protected $table = 'courses';

    public $timestamps = false;

    protected $fillable = array('prefix', 'number', 'name');

    public function TAs()
    {
    	return $this->hasMany('CourseKnowledge', 'course_id')->get();
    }

    public static function get($prefix, $number = null)
    {
    	if ($number == null)
    		return Course::where('prefix','=',$prefix)->get();
    	else return Course::whereRaw('prefix = ? AND number = ?', array($prefix,$number))->first();
    }
}