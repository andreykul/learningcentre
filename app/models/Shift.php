<?php

class Shift extends Eloquent {

    protected $table = 'shifts';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'schedule_id', 'date', 'start', 'end');

}