<?php

class TaController extends BaseController {

	public function __construct()
    {
    	$this->beforeFilter('auth');

    	if ( Auth::user()->role == 'ta' )
    	{
    		$this->user = array(
				'username' => Auth::user()->username,
				'id' => Auth::user()->id,
			);

			$this->navbar = array(
				"Profile" => url('ta/profile'),
				"Availability" => url("ta/availability"),
				"Shifts" => url("ta/shifts"),
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

	public function getProfile()
	{
		$profile = User::find(Auth::user()->id)->TA()->first();

		return View::make('ta/profile')
					->with('ta', $profile);
	}

	public function getAvailability(){
		// $hours = Schedule::

		return View::make('ta/availability')
				->with('hours', $hours);
	}


}