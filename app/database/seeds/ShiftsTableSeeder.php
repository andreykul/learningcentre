<?php 

class ShiftsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete();

        $ta = User::where('role','=','ta')->first()->TA();

        //Create shift every week for 14 weeks starting today
        for ($i=0; $i < 14; $i++) { 
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
    }
}