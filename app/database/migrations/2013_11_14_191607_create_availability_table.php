<?php

use Illuminate\Database\Migrations\Migration;

class CreateAvailabilityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('availability', function($table)
		{
			$table->increments('id');
			$table->integer('ta_id');
			$table->string('day');
			$table->integer('start');
			$table->integer('end');
			$table->boolean('prefered');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('availability');
	}

}