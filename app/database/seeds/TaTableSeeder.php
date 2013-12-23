<?php 

class TaTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ta')->delete();

        $tas = User::where('role','=','ta')->get();

        TA::create(
            array(
            'user_id' => $tas[0]->id,
            'name' => 'Mr. TA',
            'description' => 'Very good TA',
            //relative location on of the picture on the server
            'picture' => 'default.jpeg',
            'year' => 4,
            'graduate' => false,
            'wanted_hours' => 10
            )
        );

        TA::create(
            array(
            'user_id' => $tas[1]->id,
            'name' => 'Ms. TA',
            'description' => 'I like helping people',
            //relative location on of the picture on the server
            'picture' => 'default.jpeg',
            'year' => 3,
            'graduate' => false,
            'wanted_hours' => 10
            )
        );

        TA::create(
            array(
            'user_id' => $tas[2]->id,
            'name' => 'Dr. TA',
            'description' => 'I have been here for too long',
            //relative location on of the picture on the server
            'picture' => 'default.jpeg',
            'year' => 2,
            'graduate' => true,
            'wanted_hours' => 10
            )
        );
    }
}