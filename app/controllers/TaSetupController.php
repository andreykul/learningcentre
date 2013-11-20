<?php

class TaSetupController extends TaController {

	public function getSetup()
	{
		$email = Input::get('email');

		$user = User::where('email','=',$email)->first();

		if (isset($user) && $user->role == 'ta')
		{
			if( $user->created_at != $user->updated_at )
				return Redirect::to('login');
			else return View::make('ta/setup')
					->with('noLogin', true)
					->with('email', $email)
					->with('user', $user);
		}
		else return Redirect::guest('/');
	}

	public function postSetup()
	{
		$email = Input::get('email');

		$messages = array(
			'same' => 'Passwords must match.'
		);

		$validator = Validator::make(Input::all(), [
            "password" => "required|min:4",
        ], $messages);

        $validator->sometimes('password2', 'required|same:password', function($input)
		{
		    return $input->password != "";
		});

        if ( $validator->passes() )
        {
        	$user = User::where('email','=',$email)->first();

        	$user->password = Hash::make(Input::get('password'));

        	$user->save();

        	return Redirect::to('login');
        }
        else return Redirect::to('ta/setup?email='.$email)
        				->withInput()
        				->withErrors($validator);
	}
}