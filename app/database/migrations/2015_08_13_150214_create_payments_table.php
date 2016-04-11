<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('payment_types_id');
			$table->boolean('ticket');
			$table->string('paycheck_number');
			$table->date('paycheck_date');
			$table->string('paycheck_id');
			$table->integer('banks_id');
			$table->string('mount');
			$table->integer('ticketNumber');
			$table->tinyInteger('paid');
			$table->integer('vouchers_id');
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
		Schema::drop('payments');
	}

}
