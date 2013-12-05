<?php

use Illuminate\Database\Migrations\Migration;

class CreateShiftBidsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shift_bids', function($table){
			$table->increments('id');
			$table->integer('ta_id');
			$table->integer('shift_id');
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
		Schema::drop('shift_bids');
	}

}