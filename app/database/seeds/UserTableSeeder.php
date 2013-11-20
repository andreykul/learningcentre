<?php  

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(
        	array(
        		'password' => Hash::make('password'),
        		'email' => 'admin@cs.dal.ca',
        		'role' => 'admin'
    		)
    	);

        User::create(
        	array(
	    		'password' => Hash::make('password'),
	    		'email' => 'ta@cs.dal.ca',
	    		'role' => 'ta'
    		)
    	);

    	
    }
}