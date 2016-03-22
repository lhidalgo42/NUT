<?php

class TherapistDurationTableSeeder extends Seeder {

	public function run()
	{
		TherapistDuration::create([
            'therapists_id' => 1,
            'duration_id' => 4
		]);
        TherapistDuration::create([
            'therapists_id' => 1,
            'duration_id' => 5
        ]);
        TherapistDuration::create([
            'therapists_id' => 1,
            'duration_id' => 6
        ]);
        TherapistDuration::create([
            'therapists_id' => 1,
            'duration_id' => 3
        ]);
        TherapistDuration::create([
            'therapists_id' => 2,
            'duration_id' => 4
        ]);
        TherapistDuration::create([
            'therapists_id' => 2,
            'duration_id' => 5
        ]);
        TherapistDuration::create([
            'therapists_id' => 2,
            'duration_id' => 6
        ]);
        TherapistDuration::create([
            'therapists_id' => 2,
            'duration_id' => 3
        ]);
        TherapistDuration::create([
            'therapists_id' => 3,
            'duration_id' => 4
        ]);
        TherapistDuration::create([
            'therapists_id' => 3,
            'duration_id' => 5
        ]);
        TherapistDuration::create([
            'therapists_id' => 3,
            'duration_id' => 6
        ]);
        TherapistDuration::create([
            'therapists_id' => 3,
            'duration_id' => 3
        ]);

	}

}