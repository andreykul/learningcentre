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

		$this->call('UserTableSeeder');
        $this->call('TaTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('AvailabilityTableSeeder');
        $this->call('ShiftsTableSeeder');
        $this->call('CoursesTableSeeder');
	}

}

