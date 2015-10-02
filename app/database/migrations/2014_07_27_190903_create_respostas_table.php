<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respostas', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
            $table->string('resposta',255);
            $table->dateTime('data_hora');
            $table->boolean('correta')->nullable();
            $table->smallInteger('nota')->nullable();
            $table->integer('pergunta_id')->unsigned();

            $table->foreign('pergunta_id')->references('id')->on('perguntas')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('respostas', function(Blueprint $table)
		{
			Schema::drop('respostas');
		});
	}

}
