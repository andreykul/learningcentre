<?php

use Illuminate\Database\Migrations\Migration;

class ModifyTaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ta', function($table)
		{
		    $table->boolean('active')->default(true)->after('availability_updated_at');
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
		    $table->dropColumn('active');
		});
	}

}