<?php

class Settings extends Eloquent {

    protected $table = 'settings';

    //protected $hidden = array("id","created_at","updated_at");
    
    public static function get($setting)
    {
    	return Settings::where("name","=",$setting)->first();
    }

    public static function set($setting, $value)
    {
    	$setting = Settings::get($setting);

    	if (isset($setting)){
    		$setting['value'] = $value;
    		$setting->save();
    	}
    	else Settings::create(array("name"=>$setting,"value"=>$value));
    }
}