<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        User::create([
            'email' => 'eortega@inia.cl',
            'password' => '1234',
            'img' => 'avatar_2x.png',
            'name' => 'Eduardo Ortega',
            'access' => 1,
            'roles_id' => 1
        ]);
        User::create([
            'email' => 'gjury@psiconutricion.cl',
            'password' => '1234',
            'img' => 'avatar_2x.png',
            'name' => 'Gloria Jury',
            'access' => 1,
            'roles_id' => 1
        ]);
            User::create([
                'email' => 'secretaria@psiconutricion.cl',
                'password' => 's3cr3t4r14',
                'img' => 'avatar_2x.png',
                'name' => 'Magdalena',
                'access' => 1,
                'roles_id' => 1
            ]);
        User::create([
            'email' => 'leontuna@gmail.com',
            'password' => '1234',
            'img' => 'avatar_2x.png',
            'name' => 'Leonardo Hidalgo',
            'access' => 1,
            'roles_id' => 1
        ]);
	}

}