<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerguntasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perguntas', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
            $table->string('pergunta',255);
            $table->string('descricao',255);
            $table->dateTime('data_hora');
            $table->integer('questionador_id')->unsigned();

            $table->foreign('questionador_id')->references('usuario_id')->on('questionadores')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('perguntas', function(Blueprint $table)
		{
			Schema::drop('perguntas');
		});
	}

}
