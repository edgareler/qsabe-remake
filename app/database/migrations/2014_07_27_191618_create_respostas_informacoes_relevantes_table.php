<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostasInformacoesRelevantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respostas_informacoes_relevantes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('resposta_id')->unsigned();
            $table->integer('informacao_relevante_id')->unsigned();

            $table->foreign('resposta_id')->references('id')->on('respostas')->on_delete('restrict');
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
		Schema::table('respostas_informacoes_relevantes', function(Blueprint $table)
		{
			Schema::drop('respostas_informacoes_relevantes');
		});
	}

}
