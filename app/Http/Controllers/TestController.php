<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Clicklink};
use Auth;
class TestController extends Controller
{
    public function test(Request $request){

    	$discoveredlink = Auth::user()->discoverdLinks()->where('link_id', $request->id)->first();
    	
    	return $discoveredlink->pivot->codegen;
    	

    }
}
