<?php  

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