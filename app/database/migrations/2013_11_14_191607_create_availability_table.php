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
			$table->string('day')->nullable();
			$table->integer('start')->default(0);
			$table->integer('end')->default(0);
			$table->boolean('prefered')->default(false);
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