<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
	User
};
use Auth;
class RightBarController extends Controller
{
    function changeColor($color){

    	$user = Auth::user();

    	$user->color = $color;

    	$user->save();

    	return response()->json(['message' => 'The color is Changed', 'color_id' => $color ]);

    }
}
