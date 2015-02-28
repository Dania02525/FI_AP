<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vendors extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->text('address')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('mobile')->nullable();
			$table->string('email')->nullable();
			$table->string('web')->nullable();

			$table->index('name');
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
	}

}