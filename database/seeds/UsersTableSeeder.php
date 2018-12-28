<?php

use Illuminate\Database\Seeder;



use App\{User};

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {




        User::create([

                'name'           => 'Admin',
                'email'          => 'admin@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 1
            ]);

        User::create([

                'name'           => 'Admin2',
                'email'          => 'admin2@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 1
            ]);

        User::create([

                'name'           => 'Admin3',
                'email'          => 'admin3@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 1
            ]);


        User::create([

                'name'           => 'User',
                'email'          => 'user@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        User::create([

                'name'           => 'User1',
                'email'          => 'user1@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        User::create([

                'name'           => 'User2',
                'email'          => 'user2@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        User::create([

                'name'           => 'User3',
                'email'          => 'user3@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);

        User::create([

                'name'           => 'User4',
                'email'          => 'user4@click.com',
                'password'       => bcrypt('123456'),
                'remember_token' => str_random(60),
                'role'        => 0
            ]);



    }
}
