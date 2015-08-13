<?php

class TherapistdurationTableSeeder extends Seeder {

	public function run()
	{
		Therapistduration::create([
            'therapists_id' => 1,
            'duration_id' => 4
		]);
        Therapistduration::create([
            'therapists_id' => 1,
            'duration_id' => 5
        ]);
        Therapistduration::create([
            'therapists_id' => 1,
            'duration_id' => 6
        ]);
        Therapistduration::create([
            'therapists_id' => 1,
            'duration_id' => 3
        ]);

	}

}