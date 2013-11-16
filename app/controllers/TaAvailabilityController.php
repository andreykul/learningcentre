<?php

class TaAvailabilityController extends TaController {

	public function getAvailability(){
		//$hours = TA::schedule()-get();

		$this->navbar['Availability']['active'] = true;

		return View::make('ta/availability')
					->with('user', $this->user)
                    ->with('navbar',$this->navbar);
				//->with('hours', $hours);
	}

}