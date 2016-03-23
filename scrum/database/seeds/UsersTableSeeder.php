<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.de',
            'password' => bcrypt('admin'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'user1',
            'email' => 'user1@user.de',
            'password' => bcrypt('user1'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'user2',
            'email' => 'user2@user.de',
            'password' => bcrypt('user2'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'guest',
            'email' => 'guest@guest.de',
            'password' => bcrypt('guest'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'teacher1',
            'email' => 'teacher1@teacher.de',
            'password' => bcrypt('teacher1'),
            'role_id' => 3,
        ]);

//	    DB::table('users')->insert([
//		    'name' => 'tester',
//		    'email' => 'j.hoelzle@exinit.de',
//		    'password' => 'tester',
//	    ]);
//
//	    DB::table('users')->insert([
//		    'name' => 'tester2',
//		    'email' => 'jan@exinit.de',
//		    'password' => 'tester2',
//	    ]);
    }
}
