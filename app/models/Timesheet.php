<?php

class Timesheet extends Eloquent {

    protected $table = 'timesheets';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'week', 'monday', 'tuesday','wednesday','thursday','friday','saturday','sunday','memo');

    public function TA()
    {
    	return $this->belongsTo('TA','ta_id')->first();
    }
}