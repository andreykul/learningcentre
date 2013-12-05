<?php 

class ShiftsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('shifts')->delete();

        $ta = User::where('role','=','ta')->first()->TA();

        //Create shifts this week and next week
        for ($i=0; $i < 2; $i++) { 
            $time = time() + ($i * 7 * 24 * 60 * 60);

            Shift::create(
                array(
                'ta_id' => $ta->id,
                'date' => date("Y-m-d", $time),
                'start' => 1000,
                'end' => 1250
                )
            );
        }

        //Shift at the begging of the Week, Sunday
        $time = time() - date('w') * 24 * 60 * 60;

        Shift::create(
            array(
            'ta_id' => $ta->id,
            'date' => date("Y-m-d", $time),
            'start' => 1000,
            'end' => 1250
            )
        );

        //Shift at the end of the Week
        $time += 6 * 24 * 60 * 60;

        Shift::create(
            array(
            'ta_id' => $ta->id,
            'date' => date("Y-m-d", $time),
            'start' => 1500,
            'end' => 1650
            )
        );

        //Shift at the begging of the next Week
        $time += 1 * 24 * 60 * 60;

        Shift::create(
            array(
            'ta_id' => $ta->id,
            'date' => date("Y-m-d", $time),
            'start' => 1500,
            'end' => 1650
            )
        );
    }
}