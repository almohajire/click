<?php

use Illuminate\Database\Seeder;
use App\{
	User,
	Ad
};
class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$user = User::whereEmail('user@user.com')->first();

    	Ad::create(['user_id' => $user->id, 'link' => 'https://wikipedia.org']);
        
    }
}
