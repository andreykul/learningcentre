<?php

class AdminTAsController extends AdminController {


	public function getTas()
	{
		$this->navbar['TAs']['active'] = true;

		$tas = TA::all();

		// echo "<pre>";
		// foreach ($tas as $key => $ta) {
		// 	echo $ta->user()->email;
		// }
		// echo "</pre>";
		// exit();

		return View::make('admin/TAs')
					->with('tas',$tas)
					->with('user', $this->user)
					->with('navbar', $this->navbar);
	}

	public function postTa()
	{
		$email = Input::get('email');

		Mail::send('emails.newTa', array(), function($message)
		{
			$email = Input::get('email');

			$message->to($email)->subject('Welcome to the Learning Centre!');
		});

		$user = User::create(array('email' => $email));

		TA::create(array('user_id' => $user->id));

		return Redirect::to('admin/tas');
	}

	public function deleteTA($id)
	{
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