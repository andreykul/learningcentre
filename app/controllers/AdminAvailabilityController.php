<?php

class AdminAvailabilityController extends AdminController {

	public function getIndex()
	{
		$this->navbar['Availability']['active'] = true;

		$availability = array();
		$locked = Settings::get("availability_locked");
		if ($locked->value == "1")
			$availability['locked'] = true;
		else $availability['locked'] = false;

		$availability['start_time'] = Settings::get("availability_start_hour")->value;
		$availability['end_time'] = Settings::get("availability_end_hour")->value;

		$tas = TA::active();

		return View::make('admin/availability')
					->with('tas', $tas)
					->with('availability', $availability)
					->with('user', $this->user)
					->with('navbar', $this->navbar);
	}

	public function postIndex()
	{
		$settings = Input::all();

		unset($settings['_token']);

		foreach ($settings as $key => $value) {
			$setting = Settings::get($key);
			$setting->value = $value;
			$setting->save();
		}
		
		Session::flash('success',true);

		return Redirect::to('admin/availability');
	}

}