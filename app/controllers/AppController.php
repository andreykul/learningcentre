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

        $week = array(
            "Sunday" => array(),
            "Monday" => array(),
            "Tuesday" => array(),
            "Wednesday" => array(),
            "Thursday" => array(),
            "Friday" => array(),
            "Saturday" => array()
        );

        $days = array(
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        );

        $start = Settings::get("availability_start_hour")->value;
        $start = Time::ToNumber($start);
        $time['start'] = $start;

        $end = Settings::get("availability_end_hour")->value;
        $end = Time::ToNumber($end);
        $time['end'] = $end;

        $week_start = time() - (date('w') * 24 * 60 * 60);
        $week_start = date('Y-m-d', $week_start);
        $week_end = strtotime($week_start) + (6 * 24 * 60 * 60);
        $week_end = date('Y-m-d', $week_end);

        $shifts = Shift::between($week_start,$week_end);

        $assigned = array();
        foreach ($shifts as $shift) {
            for ($i=$shift->start; $i < $shift->end; $i+=50){
                $ta = $shift->TA();
                if (isset($ta))
                {
                    $day = date('l', strtotime($shift->date));
                    $assigned[$day][$i][] = $ta->name;
                }
            }
        }

        $courses = Course::all();

		return View::make('main')
                ->with('courses',$courses)
                ->with('days', $days)
                ->with('week', $week)
                ->with('assigned',$assigned)
                ->with('time', $time);
	}

	public function getLogin()
	{
        echo Redirect::back();
        
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