<?php

class AdminAvailabilityDownloadController extends AdminController {

	public function postIndex(){
		echo "Download availability for".Input::get('day');
	}
}