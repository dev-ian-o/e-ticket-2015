<?php
class StudentTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('students')->delete();

        Student::create(array(
            'lastname' => 'Student',
            'firstname' => 'One',
            'gender'    => 'female',
            'birthdate' => '1994-05-05',
            'year' => '1',
            'course' => 'BS Information Technology'
        ));
        Student::create(array(
            'lastname' => 'Student',
            'firstname' => 'Two',
            'gender'    => 'male',
            'birthdate' => '1994-05-05',
            'year' => '2',
            'course' => 'BS Computer Science'
        ));
        
        Student::create(array(
            'lastname' => 'Student',
            'firstname' => 'Three',
            'gender'    => 'male',
            'birthdate' => '1994-05-05',
            'year' => '3',
            'course' => 'BS Network Administration'
        ));
     }
}