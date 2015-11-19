<?php


class PaymentTypeTableSeeder extends Seeder
{

    public function run()
    {
        PaymentType::create([
            'name' => 'Efectivo'
        ]);
        PaymentType::create([
            'name' => 'Tarjeta'
        ]);
        PaymentType::create([
            'name' => 'Cheque'
        ]);
        PaymentType::create([
            'name' => 'Transferencia Bancaria'
        ]);
        PaymentType::create([
            'name' => 'Pendiente'
        ]);
    }

}