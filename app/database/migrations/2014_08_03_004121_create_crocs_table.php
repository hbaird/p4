<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrocsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crocs', function($table) {


			# AI Primary key
			$table->increments('id');


			# Adds created_at and updated_at columns
			$table->timestamps();


			$table->string('name');
			$table->string('family');
			$table->string('species');
			$table->string('habitat');
			$table->string('appearance');
			$table->string('image');
			$table->text('fact1');
			$table->text('fact2');
			$table->text('fact3');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crocs');
	}

}
