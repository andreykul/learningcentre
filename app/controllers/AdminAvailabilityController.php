<?php

class AdminAvailabilityController extends AdminController {

	public function getAvailability()
	{

		$availability = array();
		$locked = Settings::get("availability_locked");
		if ($locked->value == "1")
			$availability['locked'] = true;
		else $availability['locked'] = false;

		$availability['start_time'] = Settings::get("availability_start_hour")->value;
		$availability['end_time'] = Settings::get("availability_end_hour")->value;

		return View::make('admin/availability')
					->with('availability', $availability)
					->with('user', $this->user)
					->with('navbar', $this->navbar);
	}

	public function postAvailability()
	{
		$settings = Input::all();

		unset($settings['_token']);

		foreach ($settings as $key => $value) {
			$setting = Settings::get($key);
			$setting->value = $value;
			$setting->save();
		}
		
		return Redirect::to('admin/availability');
	}

}