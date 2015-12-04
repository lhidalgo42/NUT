<?php

class PaymentTableSeeder extends Seeder {

	public function run()
	{
        Payment::create([
            'payment_types_id' => 1,
            'ticket' => 0,
            'mount' => 50000
        ]);
        Payment::create([
            'payment_types_id' => 1,
            'ticket' => 0,
            'mount' => 10000
        ]);
	}

}