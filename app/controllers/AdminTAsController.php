<?php

class AdminTAsController extends AdminController {


	public function getIndex()
	{
		$this->navbar['TAs']['active'] = true;

		$tas = TA::all();

		return View::make('admin/TAs')
					->with('tas',$tas)
					->with('user', $this->user)
					->with('navbar', $this->navbar);
	}

	public function postAdd()
	{
		$validator = Validator::make(Input::all(), [
            "email" => "required|unique:users|email",
            "name" => "required"
        ]);

        if ($validator->passes())
        {
        	$email = Input::get('email');
			$name = Input::get('name');

			Mail::send('emails.newTa', array('email' => $email), function($message)
			{
				$email = Input::get('email');

				$message->to($email)->subject('Welcome to the Learning Centre!');
			});

			$user = User::create(array('email' => $email));

			TA::create(array('user_id' => $user->id, "name" => $name));

			return Redirect::to('admin/tas');
        }
        else
        {
        	return Redirect::to('admin/tas')->withErrors($validator);
        }

	}

	public function deleteRemove($id)
	{
		$ta = TA::find($id);

		$availabilities = $ta->availability();
		foreach ($availabilities as $availability)
			Availability::destroy($availability->id);
		
		User::destroy($ta->user_id);
		TA::destroy($id);

		return Redirect::to('admin/tas');
	}

	public function postTeachingAssistants()
	{
		// $settings = Input::all();

		// unset($settings['_token']);

		// foreach ($settings as $key => $value) {
		// 	$setting = Settings::get($key);
		// 	$setting->value = $value;
		// 	$setting->save();
		// }
		
		// Session::flash('success',true);

		// return Redirect::to('admin/availability');
	}

}