<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('UsersTableSeeder');
		 $this->call('RoomsTableSeeder');
		 $this->call('BankTableSeeder');
		 $this->call('PatientsTableSeeder');
		 $this->call('TherapistTableSeeder');
		 $this->call('PaymentTypeTableSeeder');
		 $this->call('PaymentTableSeeder');
		 $this->call('ScheduleTableSeeder');
		 $this->call('DurationTableSeeder');
		 $this->call('TherapistDurationTableSeeder');
	}

}
