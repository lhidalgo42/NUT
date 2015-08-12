<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::create([
        'email' => 'lhidalgo@alumnos.uai.cl',
        'password' => 'l30ntun4',
        'img' => 'avatar_2x.png',
        'name' => 'Leonardo Hidalgo'
    ]);
        User::create([
            'email' => 'eortega@inia.cl',
            'password' => '1234',
            'img' => 'avatar_2x.png',
            'name' => 'Eduardo Ortega'
        ]);

	}

}