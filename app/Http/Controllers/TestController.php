<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Clicklink};
use Auth;
use Carbon\Carbon;
class TestController extends Controller
{
    public function test(Request $request){

    	$yes = Carbon::now();
    	$link = Carbon::yesterday();
    	
    	dd(Carbon::now()->subDays(29) );
    	

    }
}
