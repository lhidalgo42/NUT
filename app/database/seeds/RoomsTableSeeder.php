<?php

class RoomsTableSeeder extends Seeder {

	public function run()
	{
		Room::create([
            'name' => 'Sala 1'
        ]);
        Room::create([
            'name' => 'Sala 2'
        ]);
        Room::create([
            'name' => 'Sala 3'
        ]);
        Room::create([
            'name' => 'Sala 4'
        ]);
        Room::create([
            'name' => 'Sala 5'
        ]);
	}

}