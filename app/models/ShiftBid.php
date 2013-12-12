<?php

class ShiftBid extends Eloquent {

    protected $table = 'shift_bids';

    public $timestamps = false;

    protected $fillable = array('ta_id', 'shift_id', 'start', 'end');

    public function TA()
    {
    	return $this->belongsTo('TA','ta_id')->first();
    }

    //Method to retrieve bids for a certain shift, with option to specify a TA
    public static function shift($id,$ta_id = null)
    {
        if ($ta_id == null)
        //Retrieve all bids for the shift
            return ShiftBid::where("shift_id",'=',$id)->get();
        //Retrieve one bid from the TA for the shift
        else return ShiftBid::whereRaw("shift_id = ? AND ta_id = ?",array($id,$ta_id))->first();
    }
}