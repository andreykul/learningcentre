<?php

use Illuminate\Database\Migrations\Migration;

class CreateTimesheetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timesheets', function($table){
			$table->increments('id');
			$table->integer('ta_id');
			$table->date("week");
			$table->float("monday")->default(0);
			$table->float("tuesday")->default(0);
			$table->float("wednesday")->default(0);
			$table->float("thursday")->default(0);
			$table->float("friday")->default(0);
			$table->float("saturday")->default(0);
			$table->float("sunday")->default(0);
			$table->float("additional")->default(0);
			$table->float("total")->default(0);
			$table->text("memo")->default("");
			$table->boolean("approved")->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("timesheets");
	}

}