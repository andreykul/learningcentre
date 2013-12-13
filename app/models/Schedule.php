<?php

class Schedule extends Eloquent {

    protected $table = 'schedule';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'start', 'end');
}