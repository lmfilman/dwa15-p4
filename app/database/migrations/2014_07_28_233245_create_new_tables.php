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
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_token')->nullable();
			$table->timestamps();

		});

		Schema::create('tags', function($table) {

			$table->increments('id');
			$table->timestamps();
			$table->string('name')->unique();

		});

		Schema::create('concoctions', function($table) {

			$table->increments('id');
			$table->string('title');
			$table->string('reference_link');
			$table->text('ingredients');
			$table->text('directions');
			$table->boolean('user_made_this')->default(false);
			$table->string('image_file_name');
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			#Foreign key to users table
			$table->foreign('user_id')->references('id')->on('users');

		});

		#Pivot table between concoctions and tags
		Schema::create('concoction_tag', function($table){

			$table->integer('concoction_id')->unsigned();
			$table->integer('tag_id')->unsigned();

			$table->foreign('concoction_id')->references('id')->on('concoctions');
			$table->foreign('tag_id')->references('id')->on('tags');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		Schema::drop('users');
		Schema::drop('tags');
		Schema::drop('concoctions');
		Schema::drop('concoction_tag');
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}
