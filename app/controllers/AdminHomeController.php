<?php

class AdminHomeController extends AdminController {

	public function getIndex(){
		return View::make('admin/index')
					->with('user', $this->user)
					->with('navbar', $this->navbar);
	}
}