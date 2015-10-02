<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialistasContextosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especialistas_contextos', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('especialista_id')->unsigned();
            $table->integer('contexto_id')->unsigned();

            $table->foreign('especialista_id')->references('usuario_id')->on('especialistas')->on_delete('restrict');
            $table->foreign('contexto_id')->references('id')->on('contextos')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('especialistas_contextos', function(Blueprint $table)
		{
			Schema::drop('especialistas_contextos');
		});
	}

}