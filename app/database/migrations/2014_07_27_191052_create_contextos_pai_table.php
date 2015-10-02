<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextosPaiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contextos_pai', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->integer('contexto_id')->unsigned();
            $table->integer('contexto_pai_id')->unsigned();

            $table->primary(array('contexto_id', 'contexto_pai_id'));
            $table->foreign('contexto_id')->references('id')->on('contextos')->on_delete('restrict');
            $table->foreign('contexto_pai_id')->references('id')->on('contextos')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contextos_pai', function(Blueprint $table)
		{
			Schema::drop('contextos_pai');
		});
	}

}
