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

		// $this->call('UserTableSeeder')
		$this->call('UserTableSeeder');
        $this->command->info('users table seeded.');

		$this->call('UserGroupTableSeeder');
        $this->command->info('user_groups table seeded.');

		$this->call('StudentTableSeeder');
        $this->command->info('students table seeded.');
	}

}
