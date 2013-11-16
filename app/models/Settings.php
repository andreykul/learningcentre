<?php

class Settings extends Eloquent {

    protected $table = 'settings';
    
    public function get($setting)
    {
    	return $this->where("name","=",$setting);
    }
}