<?php

class TherapistTableSeeder extends Seeder {

	public function run()
	{
		Therapist::create([
			'rut' => '12345678-9',
			'name' => 'Eduardo Ortega',
			'birth' => '2015-10-25',
			'phone' => '123456789',
			'cellphone' => '',
			'email' => 'eortega@inia.cl',
			'colors_id' => 3,
			'users_id' => 1
		]);
		Therapist::create([
			'rut' => '12345678-9',
			'name' => 'Gloria Jury',
			'birth' => '2015-10-25',
			'phone' => '123456789',
			'cellphone' => '',
			'email' => 'gjury@psiconutricion.cl',
			'colors_id' => 3,
			'users_id' => 2
		]);
	}
}