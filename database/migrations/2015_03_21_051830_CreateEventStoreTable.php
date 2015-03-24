<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventStoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::connection('mysql')->create('event_store', function($table)
        {
            $table->text('uuid', 80);
            $table->text('type', 100);
            $table->text('event');
            $table->string('created_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::connection('mysql')->drop('event_store');
	}

}
