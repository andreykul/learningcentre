<?php

class TaSetupController extends TaController {

	public function getSetup()
	{
		$email = Input::get('email');

		$user = User::where('email','=',$email)->first();

		if (isset($user))
			return View::make('ta/setup')
					->with('noLogin', true)
					->with('user', $user);
		else Redirect::guest('/');
	}
}