<?php

use Illuminate\Database\Migrations\Migration;

class DeleteScheduleFromShifts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shifts', function($table)
		{
			$table->dropColumn('schedule_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shifts', function($table)
		{
			$table->integer('schedule_id');
		});
	}

}