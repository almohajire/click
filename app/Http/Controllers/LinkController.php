<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User, Link};
use Auth;
class LinkController extends Controller
{
    //
      
      public function mining(){

         $links = Link::where('user_id','!=', Auth::id())->get();

         return view('users.pages.links.mining', compact('links')  );
      }

      public function mine(){

        $links = Auth::user()->links()->paginate(20);

         return view('users.pages.links.mine', compact('links')  );
      }


      public function add(){


   		return view('users.pages.links.add');
   	}
   	public function store(Request $request){

   		 $link = Link::create([

   			'link' => $request->link,
            'confirmed' => true,
   			'user_id' => Auth::id()

   		]);

   		 if($link){
   		 	return response()->json(['message' => 'Added succefully', 'item' => json_encode( $link->toArray() ) ], 200);
   		 }else{
   		 	return response()->json(['message' => 'Not stored succefully' ], 500);
   		 }

   		
   		
   	}
   	public function delete(Link $link){

   		$link->delete();

   		return response()->json(['message' => 'Deleted succefully' ], 200);
   		
   	}
}
