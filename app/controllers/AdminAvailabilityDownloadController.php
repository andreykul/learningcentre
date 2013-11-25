<?php

class AdminAvailabilityDownloadController extends AdminController {

	public function postIndex(){
		$day = Input::get('day');
		$availability = Availability::day($day);
		
		echo "<pre>";
		print_r($availability);
		echo "</pre>";
	}
}