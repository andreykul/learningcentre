<?php

class AdminController extends BaseController {

	/**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
    	$this->beforeFilter('auth');

    	if ( Auth::check() && Auth::user()->role == "admin")
    	{
    		$this->user = array(
				'username' => "Administrator",
				'id' => Auth::user()->id,
			);

			$this->navbar = array(
				'TAs' => array("url" => url('admin/tas'), 'active' => false),
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
}