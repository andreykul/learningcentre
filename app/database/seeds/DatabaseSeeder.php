<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
        $this->call('TaTableSeeder');
        
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(
        	array(
        		'username' => 'admin',
        		'password' => Hash::make('password'),
        		'email' => 'admin@cs.dal.ca',
        		'role' => 'admin'
    		)
    	);

        User::create(
        	array(
	    		'username' => 'ta',
	    		'password' => Hash::make('password'),
	    		'email' => 'ta@cs.dal.ca',
	    		'role' => 'ta'
    		)
    	);

    	
    }
}

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
            'picture' => 'images/mr_ta.jpg',
            'year' => 4,
            'graduate' => false,
            'hours' => 10
            )
        );
    }
}