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

	public function getProfile()
	{
		$profile = User::find(Auth::user()->id)->TA()->first();

		$this->navbar['Profile']['active'] = true;

		return View::make('ta/profile')
					->with('ta', $profile)
					->with('user', $this->user)
					->with('navbar',$this->navbar);
	}

	public function postProfile()
	{
		$profile = Input::all();

		// echo "<pre>";
		// print_r($profile);
		// echo "</pre>";
		// exit();

		if (Input::hasFile('picture'))
		{
			$picture = Input::file('picture');

			$type = $picture->getMimeType();

			$type = explode('/',$type)[0];

			if ($type == "image")
				$picture->move('images', $profile['picture']->getClientOriginalName());
			else unset($profile['picture']);
		}
		else unset($profile['picture']);

		$ta = User::find(Auth::user()->id)->TA()->first();

		unset($profile['_token']);

		foreach ($profile as $attribute => $value)
		{
			if ($attribute == 'picture')
				$ta[$attribute] = $value->getClientOriginalName();
			else $ta[$attribute] = $value;
		}		

		$ta->save();

		return Redirect::to('ta/profile');
	}

	public function getAvailability(){
		// $hours = Schedule::

		return View::make('ta/availability')
				->with('hours', $hours);
	}


}