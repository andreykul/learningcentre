<?php

use Illuminate\Database\Migrations\Migration;

class CreateShiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shifts', function($table){
			$table->increments('id');
			$table->integer('ta_id')->nullable();
			$table->integer('schedule_id')->nullable();
			$table->date('date');
			$table->integer('start')->unsigned()->default(0);
			$table->integer('end')->unsigned()->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shifts');
	}

}