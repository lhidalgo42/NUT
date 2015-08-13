<?php

class BankTableSeeder extends Seeder
{

    public function run()
    {
        Bank::create([
            'name' => 'BANCO DE CHILE'
        ]);
        Bank::create([
            'name' => 'BANCO INTERNACIONAL'
        ]);
        Bank::create([
            'name' => 'SCOTIABANK CHILE'
        ]);
        Bank::create([
            'name' => 'BANCO DE CREDITO E INVERSIONES '
        ]);
        Bank::create([
            'name' => 'CORPBANCA'
        ]);
        Bank::create([
            'name' => 'BANCO BICE'
        ]);
        Bank::create([
            'name' => 'HSBC BANK (CHILE)'
        ]);
        Bank::create([
            'name' => 'BANCO SANTANDER-CHILE'
        ]);
        Bank::create([
            'name' => 'BANCO ITAÚ CHILE'
        ]);
        Bank::create([
            'name' => 'BANCO SECURITY'
        ]);
        Bank::create([
            'name' => 'BANCO FALABELLA '
        ]);
        Bank::create([
            'name' => 'DEUTSCHE BANK (CHILE) '
        ]);
        Bank::create([
            'name' => 'BANCO RIPLEY'
        ]);
        Bank::create([
            'name' => 'RABOBANK CHILE (ex HNS BANCO) '
        ]);
        Bank::create([
            'name' => 'BANCO CONSORCIO (ex BANCO MONEX)'
        ]);
        Bank::create([
            'name' => 'BANCO PENTA'
        ]);
        Bank::create([
            'name' => 'BANCO PARIS '
        ]);
        Bank::create([
            'name' => 'BANCO BILBAO VIZCAYA ARGENTARIA, CHILE (BBVA) '
        ]);
        Bank::create([
            'name' => 'BANCO BTG PACTUAL CHILE'
        ]);
    }

}