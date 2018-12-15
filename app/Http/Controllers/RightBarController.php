<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
	User
};
use Auth;
class RightBarController extends Controller
{
    function changeColor(Request $request, $color){

    	$user = Auth::user();

    	$user->color = $color;

    	$user->save();

    	return response()->json(['message' => 'The color is Changed', 'color_id' => $color ]);

    }

    function shortenOpen(Request $request){

    	$user = Auth::user();

    	$user->shorten_open = $request->value;

    	$user->save();

    	return response()->json(['message' => 'The shorten open is Changed', 'value' => $user->shorten_open ]);

    }
}
