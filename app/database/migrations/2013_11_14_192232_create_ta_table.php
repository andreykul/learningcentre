<?php

use Illuminate\Database\Migrations\Migration;

class CreateTaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ta', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('name');
			$table->text('description');
			//relative location on of the picture on the server
			$table->string('picture');
			$table->integer('year');
			$table->boolean('graduate');
			$table->integer('hours');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ta');
	}

}