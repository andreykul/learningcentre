<?php

class AppController extends BaseController {

	/**
	 * The main page of the application
	 *
	 * @return Main page view
	 */
	public function getIndex()
	{
		if ( Auth::check() )
		{
			if (Auth::user()->role == 'admin')
				return Redirect::to('admin');

			if (Auth::user()->role == 'ta')
				return Redirect::to('ta');
		}
		return View::make('main');
	}

	public function getLogin()
	{
        if (Auth::check())
            return Redirect::to("/");

		return View::make('login')
				->with('noLogin',true);
	}

	public function postLogin()
    {
        $validator = Validator::make(Input::all(), [
            "email" => "required",
            "password" => "required"
        ]);

        if ($validator->passes())
        {
            $credentials = [
                "email" => Input::get("email"),
                "password" => Input::get("password")
            ];

            //Login attempt, remember user if logged in
            if (Auth::attempt($credentials, true))
            {
                if (Auth::user()->role == 'admin')
                    return Redirect::to("admin");
                else return Redirect::to("ta");
            }
            else 
            {
	            $errors['password'] = "Username and/or password invalid.";

	            return Redirect::to("login")
	                ->withInput()
	                ->withErrors($errors);
            }
        }
        else 
        {
            return Redirect::to("login")
                ->withInput()
                ->withErrors($validator);
        }

    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}