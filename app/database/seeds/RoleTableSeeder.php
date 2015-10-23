<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RoleTableSeeder extends Seeder {

	public function run()
	{
		Role::create([
			'name' => 'administrador'
		]);
		Role::create([
			'name' => 'Secretaria'
		]);
		Role::create([
			'name' => 'Terapeuta'
		]);

	}

}