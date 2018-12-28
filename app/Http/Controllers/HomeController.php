<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    User
};
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $bestusers = User::where('role', 0)->orderBy('points', 'desc')->take(10)->get();

        if( Auth::user()->is_admin ){
            $bestadmins = User::where('role','>', 0)->orderBy('points', 'desc')->take(10)->get();
        }else{
            $bestadmins = User::take(0)->get();
        }


        return view('users.pages.home', compact('bestusers', 'bestadmins'));
    }

}