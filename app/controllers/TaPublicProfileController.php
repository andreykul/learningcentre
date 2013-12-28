<?php

class TaPublicProfileController extends BaseController {

	public function getIndex()
	{
		$ta = Input::get('ta');

		if(! isset($ta))
			return Redirect::to('/');

		$profile = TA::where('name','=',$ta)->first();

        return View::make('ta/public/profile')
                    ->with('ta', $profile);
	}
}