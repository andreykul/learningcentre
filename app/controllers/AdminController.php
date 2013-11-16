<?php

class AdminController extends BaseController {

	/**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
    	$this->beforeFilter('auth');

    	if ( Auth::user()->role == "admin")
    	{
    		$this->user = array(
				'username' => Auth::user()->username,
				'id' => Auth::user()->id,
			);

			$this->navbar = array(
				//'Teaching Assistants' => url('admin/teachingAssistants'),
				'Availability' => array("url" => url('admin/availability'), "active" => false),
				//'Shifts' => url('admin/shifts')
			);
    	}
    	else
    	{
    		Auth::logout();
    		return Redirect::to('login');
    	}
    	
    }

	public function getIndex(){
		return View::make('admin/index')
					->with('user', $this->user)
					->with('navbar', $this->navbar);
	}


	public function getAvailability()
	{

	}

	public function getShifts()
	{

	}
}