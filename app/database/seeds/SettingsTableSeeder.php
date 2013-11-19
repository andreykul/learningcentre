<?php 

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete();

        Settings::create(
            array(
            'name' => "availability_locked",
            'value' => "0"
            )
        );

		Settings::create(
            array(
            'name' => "availability_start_hour",
            'value' => "10:00"
            )
        );

        Settings::create(
            array(
            'name' => "availability_end_hour",
            'value' => "20:00"
            )
        );
    }
}