<?php


class DurationTableSeeder extends Seeder {

	public function run()
	{
		Duration::create([
            'name' => '15 Minutos',
            'timestamp' => 60*15
		]);
        Duration::create([
            'name' => '30 Minutos',
            'timestamp' => 60*30
        ]);
        Duration::create([
            'name' => '45 Minutos',
            'timestamp' => 60*45
        ]);
        Duration::create([
            'name' => '60 Minutos',
            'timestamp' => 60*60
        ]);
        Duration::create([
            'name' => '75 Minutos',
            'timestamp' => 60*75
        ]);
        Duration::create([
            'name' => '90 Minutos',
            'timestamp' => 60*90
        ]);

	}

}