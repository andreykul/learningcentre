<?php 

class TaTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ta')->delete();

        $ta = User::where('role','=','ta')->first();

        TA::create(
            array(
            'user_id' => $ta->id,
            'name' => 'Mr. TA',
            'description' => 'Very good TA',
            //relative location on of the picture on the server
            'picture' => 'default.jpeg',
            'year' => 4,
            'graduate' => false,
            'hours' => 10
            )
        );
    }
}