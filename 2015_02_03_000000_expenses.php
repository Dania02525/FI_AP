<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expenses extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expenses', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('vendor_id');
			$table->integer('invoice_group_id');
			$table->date('date');
			$table->decimal('amount', 10, 2);
			$table->string('number');
			$table->string('note');
			$table->timestamps();
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
