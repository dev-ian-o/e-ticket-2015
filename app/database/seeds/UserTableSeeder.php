<?php
class UserTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
    
        User::create(array(
            'username' => 'ianolinares@ymail.com',
            'password' => Hash::make('password'),
            'email'    => 'ianolinares@ymail.com',
            'user_group_id' => '1'
        ));
        User::create(array(
            'username' => 'sample@gmail.com',
            'password' => Hash::make('password'),
            'email'    => 'sample@gmail.com',
            'user_group_id' => '2'
        ));
        
        User::create(array(
            'username' => 'paucasto@gmail.com',
            'password' => Hash::make('password'),
            'email'    => 'paucasto@gmail.com',
            'user_group_id' => '3'
        ));
     }
}