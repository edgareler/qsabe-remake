<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contextos', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
            $table->string('nome',255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contextos', function(Blueprint $table)
		{
			Schema::drop('contextos');
		});
	}

}
