<?php

class ScheduleTableSeeder extends Seeder {

	public function run()
	{
		Schedule::create([
            'users_id' => 2,
            'patients_id' => 1,
            'therapists_id' => 1,
            'rooms_id' => 3,
            'start' => date("Y-m-d H:i").':00',
            'end' => date("Y-m-d H:i",(time()+60*90)).':00',
            'status' => '1'
        ]);
        Schedule::create([
            'users_id' => 2,
            'patients_id' => 1,
            'therapists_id' => 1,
            'rooms_id' => 3,
            'start' => date("Y-m-d H:i",(time()+60*95)).':00',
            'end' => date("Y-m-d H:i",(time()+60*185)).':00',
            'status' => '2'
        ]);
	}

}