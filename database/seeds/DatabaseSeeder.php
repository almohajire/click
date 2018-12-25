<?php

use Illuminate\Database\Seeder;
use App\{User};
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ConfigSeeder::class);


        $this->call(UsersTableSeeder::class);


        $this->call(LinkSeeder::class);



////////////



///








        $this->call(AdSeeder::class);
    }
}
