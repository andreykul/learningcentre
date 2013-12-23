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
		    $table->float('current_hours')->default(0)->after('hours');
		    $table->float('wanted_hours')->after('hours');
			$table->dropColumn('hours');
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
			$table->integer('hours')->after('graduate');
			$table->dropColumn('wanted_hours');
		    $table->dropColumn('current_hours');
		});
	}

}