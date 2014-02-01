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
        $profile = Input::except(array('_method','_token'));

        if ( empty($profile['name']) )
        {
            Session::flash('fail', "Name cannot be empty!");
            return Redirect::to('ta/profile');
        }

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
            else
            {
                Session::flash('fail', "File must be an image!");
                return Redirect::to('ta/profile');
            }
        }
        else unset($profile['picture']);

        $ta = Auth::user()->TA();

        foreach ($profile as $attribute => $value)
            $ta[$attribute] = $value;

        $ta->save();

        Session::flash('success',"Profile changes have been saved!");
        return Redirect::to('ta/profile');
    }

    public function deleteIndex()
    {
        $ta = Auth::user()->TA();
        $ta->active = 0;
        $ta->availability_updated_at = null;
        $ta->save();

        $availabilities = $ta->availability();

        //Remove TA's availability
        foreach ($availabilities as $availability)
            Availability::destroy($availability->id);

        return Redirect::to('ta/profile');
    }

    public function postIndex()
    {
        $ta = Auth::user()->TA();
        $ta->active = 1;
        $ta->save();
        
        return Redirect::to('ta/profile');
    }
	
}