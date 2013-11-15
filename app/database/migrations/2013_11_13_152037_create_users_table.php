<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Create a users table with email and password
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('role');
			$table->timestamps();
		});
	}

	/**
	 * Remove the users table
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}