<?php

use Illuminate\Database\Migrations\Migration;

class ModifyTaTableAgain extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ta', function($table)
		{
			$table->renameColumn('hours', 'wanted_hours');
		    $table->integer('current_hours')->default(0)->after('hours');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ta', function($table)
		{
			$table->renameColumn('wanted_hours', 'hours');
		    $table->dropColumn('current_hours');
		});
	}

}