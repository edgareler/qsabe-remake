<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostasEspecialistasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respostas_especialistas', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('resposta_id')->unsigned();
            $table->integer('especialista_id')->unsigned();

            $table->foreign('resposta_id')->references('id')->on('respostas')->on_delete('restrict');
            $table->foreign('especialista_id')->references('usuario_id')->on('especialistas')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('respostas_especialistas', function(Blueprint $table)
		{
			Schema::drop('respostas_especialistas');
		});
	}

}
