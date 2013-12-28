<?php 

class CoursesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('courses')->delete();

        Course::create(
            array(
                'prefix' => 'CSCI',
                'number' => '1100',
                'name' => 'Introduction to Computer Science I'
            )
        );

        Course::create(
            array(
                'prefix' => 'CSCI',
                'number' => '1101',
                'name' => 'Introduction to Computer Science II'
            )
        );

        Course::create(
            array(
                'prefix' => 'INFX',
                'number' => '1606',
                'name' => 'Introduction to Web Creation'
            )
        );

        Course::create(
            array(
                'prefix' => 'CSCI',
                'number' => '2112',
                'name' => 'Introduction to Discrete Math'
            )
        );
    }
}