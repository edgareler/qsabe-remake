<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacoesRelevantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('informacoes_relevantes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
            $table->string('informacao',255);
            $table->integer('resposta_id')->unsigned();

            $table->foreign('resposta_id')->references('id')->on('respostas')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('informacoes_relevantes', function(Blueprint $table)
		{
			Schema::drop('informacoes_relevantes');
		});
	}

}