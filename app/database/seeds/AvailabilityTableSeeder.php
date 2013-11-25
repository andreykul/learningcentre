<?php 

class AvailabilityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('availability')->delete();

        $ta = User::where('role','=','ta')->first()->TA();

        $ta->availability_updated_at = date('Y-m-d H:i:s');

        $ta->save();

        Availability::create(
            array(
            'ta_id' => $ta->id,
            'day' => 'Monday',
            'start' => 1000,
            'end' => 1250,
            'prefered' => true
            )
        );

        Availability::create(
            array(
            'ta_id' => $ta->id,
            'day' => 'Monday',
            'start' => 1450,
            'end' => 1800,
            'prefered' => false
            )
        );

        Availability::create(
            array(
            'ta_id' => $ta->id,
            'day' => 'Tuesday',
            'start' => 1000,
            'end' => 1300,
            'prefered' => true
            )
        );
    }
}