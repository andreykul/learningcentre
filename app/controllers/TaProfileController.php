<?php

class TaProfileController extends TaController {

    public function getIndex()
    {
        $profile = Auth::user()->TA();

        $this->navbar['Profile']['active'] = true;

        return View::make('ta/profile')
                    ->with('ta', $profile)
                    ->with('user', $this->user)
                    ->with('navbar',$this->navbar);
    }

    public function putIndex()
    {
        $validator = Validator::make(Input::all(), [
            "name" => "required",
        ]);

        if ($this->user['active'] && $validator->passes())
        {
            $profile = Input::except('_method');

            if (Input::hasFile('picture'))
            {
                $picture = Input::file('picture');

                $type = $picture->getMimeType();

                $type = explode('/',$type)[0];

                if ($type == "image")
                {
                    $picture->move('images', $picture->getClientOriginalName());
                    $profile['picture'] = $picture->getClientOriginalName();
                }
                else unset($profile['picture']);
            }
            else unset($profile['picture']);

            $ta = User::find(Auth::user()->id)->TA();

            unset($profile['_token']);

            foreach ($profile as $attribute => $value)
                $ta[$attribute] = $value;

            $ta->save();

            return Redirect::to('ta/profile');
        }
        else
        {
            //Display error message since name is required
            return Redirect::to('ta/profile');   
        }
    }

    public function deleteIndex()
    {
        echo "I want to deactivate my account!";
    }
	
}