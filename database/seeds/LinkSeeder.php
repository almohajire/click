<?php

use Illuminate\Database\Seeder;
use App\{User, Link};
class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        for ( $x = 0; $x <= 5; $x++) {


	        $users = User::all()->each(function ($b_user, $key){

	        	$hash = md5( $b_user->id. str_random(15) );

	        	Link::create([

	        		

	        		'link' => 'http://127.0.0.1:8000/link/detect/'.$hash,
	                'hash' => $hash,
	                'user_id' => $b_user->id,
	                'confirmed' => true,
	                'level' => 2


	        	]);

	        });

		    
		}





    }
}
