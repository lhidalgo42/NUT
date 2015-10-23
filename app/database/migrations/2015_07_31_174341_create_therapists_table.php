<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTherapistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('therapists', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('rut');
            $table->string('name');
            $table->date('birth');
            $table->string('phone');
            $table->string('cellphone');
            $table->string('email');
            $table->integer('colors_id')->default('1');
			$table->integer('users_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('therapists');
	}

}
