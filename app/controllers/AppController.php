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
		return View::make('login')
				->with('loginPage',true);
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
	            $data["email"] = Input::get("email");
	            $errors['password'] = "Username and/or password invalid.";

	            return Redirect::to("login")
	                ->withInput($data)
	                ->withErrors($errors);
            }
        }
        else 
        {
            $data["email"] = Input::get("email");
            $errors['password'] = "Username and password are required.";

            return Redirect::to("login")
                ->withInput($data)
                ->withErrors($errors);
        }

    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}