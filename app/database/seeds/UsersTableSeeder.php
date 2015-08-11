<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::create([
            'email' => 'demo@nut.cl',
            'password' => '123',
            'img' => 'avatar_2x.png',
            'name' => 'Demo',
            'lastName' => 'NUT'
		]);

	}

}