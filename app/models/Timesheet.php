<?php

class Timesheet extends Eloquent {

    protected $table = 'timesheets';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'week', 'monday', 'tuesday','wednesday','thursday','friday','saturday','sunday','additional','total','memo');

    public function TA()
    {
    	return $this->belongsTo('TA','ta_id')->first();
    }
}