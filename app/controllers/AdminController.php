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
				'Schedule' => array("url" => url('admin/schedule'), "active" => false),
			);
    	}
    	else
    	{
    		Auth::logout();
    		return Redirect::to('login');
    	}
    	
    }
}