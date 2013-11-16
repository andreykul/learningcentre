<?php

use Illuminate\Database\Migrations\Migration;

class RenameScheduleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename("schedule","availability");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename("availability","schedule");
	}

}