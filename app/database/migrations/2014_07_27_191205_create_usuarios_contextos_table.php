<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosContextosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios_contextos', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('usuario_id')->unsigned();
            $table->integer('contexto_id')->unsigned();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->on_delete('restrict');
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
		Schema::table('usuarios_contextos', function(Blueprint $table)
		{
			Schema::drop('usuarios_contextos');
		});
	}

}
