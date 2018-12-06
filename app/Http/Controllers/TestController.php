<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Clicklink};
class TestController extends Controller
{
    public function test(){

    	return Clicklink::findOrFail(2);

    }
}
