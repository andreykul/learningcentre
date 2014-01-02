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
			$table->text('description')->nullable();
			$table->string('picture')->default('default.jpeg');
			$table->integer('year')->unsigned()->default(1);
			$table->boolean('graduate')->default(false);
			$table->integer('hours')->unsigned()->default(0);
			$table->dateTime('availability_updated_at')->nullable();
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