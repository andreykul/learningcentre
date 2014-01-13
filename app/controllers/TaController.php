<?php

class TaController extends BaseController {


	public function __construct()
    {
    	$this->beforeFilter('auth');

    	if ( Auth::check() && Auth::user()->role == 'ta' )
    	{
            $ta = Auth::user()->TA();

    		$this->user = array(
				'username' => $ta->name,
                'active' => $ta->active
			);

			$this->navbar = array(
				"Profile" => array("url" => url('ta/profile'), 'active' => false)
				
			);

            if ( $this->user['active'] == 1 )
            {
                $this->navbar['Availability'] = array("url" => url("ta/availability"), 'active' => false);
                $this->navbar["Shifts"] = array("url" => url("ta/shifts"), 'active' => false);
                $this->navbar["Hours"] = array("url" => url("ta/hours"), 'active' => false);
            }

    	}
	    else 
    	{
    		Auth::Logout();
    		return Redirect::to('login');
    	}
    }
}