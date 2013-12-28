<?php

use Illuminate\Database\Migrations\Migration;

class CreateCourseKnowledgeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_knowledge', function($table){
			$table->increments('id');
			$table->integer('ta_id');
			$table->integer('course_id');
			$table->integer('knowledge');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_knowledge');
	}

}