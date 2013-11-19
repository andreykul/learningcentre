<?php

class TaController extends BaseController {


	public function __construct()
    {
    	$this->beforeFilter('auth');

    	if ( Auth::check() && Auth::user()->role == 'ta' )
    	{
    		$this->user = array(
				'username' => Auth::user()->username,
				'id' => Auth::user()->id,
			);

			$this->navbar = array(
				"Profile" => array("url" => url('ta/profile'), 'active' => false),
				"Availability" => array("url" => url("ta/availability"), 'active' => false),
				"Shifts" => array("url" => url("ta/shifts"), 'active' => false),
			);
    	}
	    else 
    	{
    		Auth::Logout();
    		return Redirect::to('login');
    	}
    }

	public function getIndex()
	{
		return View::make('ta/index')
					->with('user', $this->user)
					->with('navbar',$this->navbar);
	}

}