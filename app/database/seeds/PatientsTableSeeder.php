<?php

class PatientsTableSeeder extends Seeder {

	public function run()
	{
	    Patient::create([
            'rut' => '18.541.556-2',
            'name' => 'Leonardo Hidalgo',
            'birth' => '1993-09-09',
            'phone' => '+56979496212',
            'email' => 'lhidalgo@alumnos.uai.cl',
            'recommendation_id' => '1'
        ]);

	}

}