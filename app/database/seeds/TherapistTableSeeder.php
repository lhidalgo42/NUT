<?php

class TherapistTableSeeder extends Seeder {

	public function run()
	{
		Therapist::create([
			'rut' => '18541556-2',
			'name' => 'Leonardo Hidalgo',
			'birth' => '1993-09-09',
			'phone' => '79496212',
			'cellphone' => '',
			'email' => 'lhidalgo@alumnos.uai.cl',
			'colors_id' => 3
		]);

	}

}