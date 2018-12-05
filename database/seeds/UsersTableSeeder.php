<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;


use App\User as Usernormal;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {


        

/*

        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
            ]);
        }

*/

        Usernormal::create([

                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 1
            ]);


        Usernormal::create([

                'name'           => 'User',
                'email'          => 'user@user.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        Usernormal::create([

                'name'           => 'User1',
                'email'          => 'user1@user.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        Usernormal::create([

                'name'           => 'User2',
                'email'          => 'user2@user.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        Usernormal::create([

                'name'           => 'User3',
                'email'          => 'user3@user.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        Usernormal::create([

                'name'           => 'User4',
                'email'          => 'user4@user.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);



    }
}
