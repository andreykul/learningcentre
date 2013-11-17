<?php 

class AvailabilityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('availability')->delete();

        $ta = User::where('role','=','ta')->first()->TA();

        Availability::create(
            array(
            'ta_id' => $ta->id,
            'day' => 'Monday',
            'start' => "10:00",
            'end' => "12:30",
            'preffered' => true
            )
        );

        Availability::create(
            array(
            'ta_id' => $ta->id,
            'day' => 'Monday',
            'start' => "14:30",
            'end' => "18:00",
            'preffered' => false
            )
        );

        Availability::create(
            array(
            'ta_id' => $ta->id,
            'day' => 'Tuesday',
            'start' => "10:00",
            'end' => "13:00",
            'preffered' => true
            )
        );
    }
}