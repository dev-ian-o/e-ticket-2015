<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('event_id')->unsigned();
			$table->integer('customer_id')->unsigned();
			$table->string('ticket_no');
			$table->string('account_status');
			$table->float('balance');
			$table->softDeletes();
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
		Schema::drop('event_customers');
	}

}
