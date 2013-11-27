<?php

class TaHomeController extends TaController {

	public function getIndex()
	{
		return View::make('ta/index')
					->with('user', $this->user)
					->with('navbar',$this->navbar);
	}

}