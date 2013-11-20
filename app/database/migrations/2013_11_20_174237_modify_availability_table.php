<?php

use Illuminate\Database\Migrations\Migration;

class ModifyAvailabilityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('availability', function($table)
		{
		    $table->dropColumn('created_at');
		    $table->dropColumn('updated_at');
		});

		Schema::table('ta', function($table)
		{
		    $table->dateTime('availability_updated_at')->after('hours');;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('availability', function($table)
		{
		    $table->dateTime('created_at');
		    $table->dateTime('updated_at');
		});

		Schema::table('ta', function($table)
		{
		    $table->dropColumn('availability_updated_at');
		});
	}

}