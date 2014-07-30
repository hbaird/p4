<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrocodiliansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crocodilians', function($table) {


			# AI Primary key
			$table->increments('id');


			# Adds created_at and updated_at columns
			$table->timestamps();


			$table->string('name');
			$table->string('species');
			$table->string('region');
			$table->string('appearance');
			$table->binary('image');




		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crocodilians');
	}

}
