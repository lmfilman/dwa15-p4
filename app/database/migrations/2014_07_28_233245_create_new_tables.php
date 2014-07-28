<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {

			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('password');

		});

		Schema::create('tags', function($table) {

			$table->increments('id');
			$table->string('name');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('users');
	}

}
