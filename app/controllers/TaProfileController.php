<?php

class TaProfileController extends TaController {

    public function getProfile()
    {
        $profile = Auth::user()->TA();

        $this->navbar['Profile']['active'] = true;

        return View::make('ta/profile')
                    ->with('ta', $profile)
                    ->with('user', $this->user)
                    ->with('navbar',$this->navbar);
    }

    public function postProfile()
    {
        $validator = Validator::make(Input::all(), [
            "name" => "required",
            "picture" => "image",
            "hours" => "min:0",
            "year" => "min:1"
        ]);

        if ($validator->passes())
        {
            $profile = Input::all();

            if (Input::hasFile('picture'))
            {
                $picture = Input::file('picture');

                $type = $picture->getMimeType();

                $type = explode('/',$type)[0];

                if ($type == "image")
                    $picture->move('images', $profile['picture']->getClientOriginalName());
                else unset($profile['picture']);
            }
            else unset($profile['picture']);

            $ta = User::find(Auth::user()->id)->TA()->first();

            unset($profile['_token']);

            foreach ($profile as $attribute => $value)
            {
                if ($attribute == 'picture')
                    $ta[$attribute] = $value->getClientOriginalName();
                else $ta[$attribute] = $value;
            }       

            $ta->save();

            return Redirect::to('ta/profile');
        }
        else
        {
            //Display error message since name is required

            return Redirect::to('ta/profile');   
        }
    }
	
}