<?php
class UserGroupTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('user_groups')->delete();
    
        UserGroup::create(array(
            'id' => '1',
            'groupname' => 'admin',
        ));
        UserGroup::create(array(
            'id' => '2',
            'groupname' => 'accounting',
        ));
        UserGroup::create(array(
            'id' => '3',
            'groupname' => 'registration',
        ));
     }
}