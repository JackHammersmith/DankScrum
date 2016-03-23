<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'title' => 'Admin',
            'privilege_id' => 1,
        ]);

        Role::create([
            'title' => 'User',
            'privilege_id' => 2,
        ]);

	    Role::create([
		    'title' => 'Guest',
		    'privilege_id' => 3,
	    ]);

        Role::create([
            'title' => 'Teacher',
            'privilege_id' => 4,
        ]);

    }
}
