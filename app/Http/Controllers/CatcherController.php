<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{
  User,
  Catcher
};

class CatcherController extends Controller
{
    //
    public function logs(User $user){

      $infos = $user->catchers->toArray() ;
      return response()->json(['infos' => $infos]);
      
    }
}
