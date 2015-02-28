<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingColumnDesignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('designs', function(Blueprint $table)
		{
			$table->dropColumn('event_id');
			$table->softDeletes();
			$table->string('design_path');
			$table->binary('json_object');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('designs', function(Blueprint $table)
		{
			//
		});
	}

}
