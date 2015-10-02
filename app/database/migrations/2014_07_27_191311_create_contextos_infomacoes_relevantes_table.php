<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextosInfomacoesRelevantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contextos_infomacoes_relevantes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('contexto_id')->unsigned();
            $table->integer('informacao_relevante_id')->unsigned();

            $table->foreign('contexto_id')->references('id')->on('contextos')->on_delete('restrict');
            $table->foreign('informacao_relevante_id')->references('id')->on('informacoes_relevantes')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contextos_infomacoes_relevantes', function(Blueprint $table)
		{
			Schema::drop('contextos_infomacoes_relevantes');
		});
	}

}
