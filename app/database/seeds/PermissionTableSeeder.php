<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PermissionTableSeeder extends Seeder {

	public function run()
	{
 		Permission::create([
			'name' => 'Acceso al Calendario General',
			'description' => 'Permite el Acceso al Calendario General'
		]);
		Permission::create([
			'name' => 'Acceso al Listado de Pacientes',
			'description' => 'Permite el Acceso al Listado de paciente, permitiendo agregar, eliminar  y/o editarlo '
		]);
		Permission::create([
			'name' => 'Acceso al Listado de Terapeutas',
			'description' => 'Permite el Acceso al Listado de terapeuta, permitiendo agregar, eliminar  y/o editarlo '
		]);
		Permission::create([
			'name' => 'Acceso al Listado de Salas',
			'description' => 'Permite el Acceso al Listado de salas, permitiendo agregar, eliminar  y/o editarlo '
		]);
		Permission::create([
			'name' => 'Acceso al Admin',
			'description' => 'Permite el Acceso al Administrador , que le permite controlar el sistema.'
		]);
	}

}