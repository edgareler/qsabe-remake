<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerguntasContextosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perguntas_contextos', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('pergunta_id')->unsigned();
            $table->integer('contexto_id')->unsigned();

            $table->foreign('pergunta_id')->references('id')->on('perguntas')->on_delete('restrict');
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
		Schema::table('perguntas_contextos', function(Blueprint $table)
		{
			Schema::drop('perguntas_contextos');
		});
	}

}
