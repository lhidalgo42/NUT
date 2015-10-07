<?php

class ColorTableSeeder extends Seeder {

	public function run()
	{
		Color::create([
			'name' => 'Blanco',
			'text' => '#333',
			'color' => '#fff',
			'border' => '#ccc',
			'className' => 'btn-default'
		]);
		Color::create([
			'name' => 'Azul',
			'text' => '#fff',
			'color' => '#286090',
			'border' => '#204d74',
			'className' => 'btn-primary'
		]);
		Color::create([
			'name' => 'Verde',
			'text' => '#fff',
			'color' => '#449d44',
			'border' => '#398439',
			'className' => 'btn-success'
		]);
		Color::create([
			'name' => 'Celeste',
			'text' => '#fff',
			'color' => '#31b0d5',
			'border' => '#269abc',
			'className' => 'btn-info'
		]);
		Color::create([
			'name' => 'Amarillo',
			'text' => '#fff',
			'color' => '#ec971f',
			'border' => '#d58512',
			'className' => 'btn-warning'
		]);
		Color::create([
			'name' => 'Rojo',
			'text' => '#fff',
			'color' => '#c9302c',
			'border' => '#ac2925',
			'className' => 'btn-danger'
		]);
	}

}