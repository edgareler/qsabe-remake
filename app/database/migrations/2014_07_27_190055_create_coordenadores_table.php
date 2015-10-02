<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordenadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coordenadores', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->integer('usuario_id')->unsigned();

			$table->primary('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('coordenadores', function(Blueprint $table)
		{
			Schema::drop('coordenadores');
		});
	}

}
