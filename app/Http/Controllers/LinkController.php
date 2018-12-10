<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\{User, Link, Ad, Clicklink};
use Auth;

use Session;
class LinkController extends Controller
{
    //
      public function check(Request $request, User $user, Link $link){
         $user = Auth::user();

         $codegen = $request->codegen;

         //Hna fin ymkan ykoun mchkiil

         $discoveredlink = $user->discoverdLinks()->where('link_id', $link->id)->first();


         if( $discoveredlink ){

          //dd( $discoveredlink->pivot->codegen , $codegen );


         if( $discoveredlink->pivot->codegen == $codegen){

            //dd($discoveredlink->pivot->id);
            //return response()->json(['message' => $discoveredlink->pivot->id ], 200);

            $clicklink = Clicklink::findOrFail( $discoveredlink->pivot->id );

            $clicklink->delete();

            $user->increment('number_click');



            $link->user->number_clicked = $link->user->increment('number_clicked') ;




            return response()->json(['message' => 'Codegen is correct' ], 200);

         }else{

            return response()->json(['message' => 'Not stored succefully because of codegen' ], 500);

         }







         }else{

            return response()->json(['message' => 'Not stored succefully because of link' ], 500);

         }

   
         
      }





      public function originaleSend(){
         return view('users.pages.links.send');
      }
      public function originale( Request $request ){

         $url = $request->url;

         //dd( $url );


      $ch = curl_init($url);
          curl_setopt($ch,CURLOPT_HEADER,true); // Get header information
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION,false);
          $header = curl_exec($ch);

          $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header)); // Parse information

          for($i=0;$i<count($fields);$i++)
          {
              if(strpos($fields[$i],'Location') !== false)
              {
                  $url = str_replace("Location: ","",$fields[$i]);
              }
          }


          return $url;


      }


      public function detect($detect = null){

         /*

            $table->string('link');
            $table->integer('clicked')->default(0);
            $table->boolean('confirmed')->default(false);
            $table->string('hash');
            //$table->string('ip');
            $table->integer('user_id')->index()->insigned();


         */

         if( $detect == null){

            $user = Auth::user();

            $hash = Hash::make( $user->id. str_random(15) );

            Session::put('lastHash', $hash);

            return $hash;

         }else{

            $link = Link::whereHash($detect)->first();

            if( $link ){

               

               return view('users.pages.links.check', compact('link'));

            }else{


               return 'Sirbhalk';
            }

            

         }


         
      }


      public function mining(){

        


/*
        if ( (Auth::user()->number_click - Auth::user()->number_clicked) >= 100 ){



        //   //9anoun 9dim

           $manyLink = Auth::user()->number_click - Auth::user()->number_clicked ;

           $links = Link::where('user_id','!=', Auth::id())->take($manyLink)->paginate(20);


          $manyLink = Auth::user()->number_click - Auth::user()->number_clicked ;

          $links = Link::where('user_id','!=', Auth::id())->take($manyLink)->paginate(20);

        }else{

          $links = Link::where('user_id','!=', Auth::id())->paginate(20);


        }

        // if( (Auth::user()->number_click - Auth::user()->number_clicked) < 2 ){

        //   //9anoun Jedid

        //   



        // }else{

        //   //9anoun 9dim

        //   $manyLink = Auth::user()->number_click - Auth::user()->number_clicked ;

        //   $links = Link::where('user_id','!=', Auth::id())->take($manyLink)->paginate(20);

        }

        
*/
/*
        //$links = collect();

        $links = Link::take(0)->get();

        $admins = User::where('role', '>' , 0)->get();

        foreach($admins as $admin){
          $links->add( $admin->links );
        }


        $links->add( Link::where('user_id','!=', Auth::id())->get() );

        //$links->paginate(20);

        //dd( $links );
        */

        //$admins = User::where('role', '>' , 0)->get(['id'])->toArray();

        $linkClicked = Clicklink::onlyTrashed()->where('user_id', Auth::id() )->get(['link_id'])->toArray();

        $links = Link::take(0)->get();

        $admins = User::where('role', '>' , 0)->get();


        foreach($admins as $admin){
          $links->add( $admin->links()->whereNotIn('id', $linkClicked )->get() );
        }



        $links = Link::where('user_id','!=', Auth::id())->whereNotIn('id', $linkClicked )
        //->whereIn('user_id', $admins)
        ->paginate(20);
        // if( $links == 0){

        //   return view('users.pages.links.mining');

        // }else{

         return view('users.pages.links.mining', compact('links')  );//}
      }

      public function mine(){

        $links = Auth::user()->links()->paginate(20);

         return view('users.pages.links.mine', compact('links')  );
      }

      public function surf(Request $request){

         //dd($link->link);

         return view('users.pages.links.surf');
      }

      public function surf2(Request $request, Link $link){

         $user = Auth::user();

         if( !$user->discoverdLinks()->where('link_id', $link->id)->first() ){

            $user->discoverdLinks()->attach( $link->id ,[
               'codegen' => Hash::make( $user->id. $link->id . str_random(15) )
            ]);


         }

         $discoveredlink = $user->discoverdLinks()->where('link_id', $link->id)->firstOrFail();

         $codegen = $discoveredlink->pivot->codegen;
         
         $displayLink = Ad::first();

         if( $displayLink ){
            $displayLink = Ad::create([
              'link' => 'https://laracasts.com',
              'user_id' => Auth::id()   
            ]);


         }

         return view('users.pages.links.surf2', compact('link', 'displayLink', 'codegen'))  ;
      }


      public function add(){

        // Giving an Hash
         $hash = $this->detect();


   		return view('users.pages.links.add', compact('hash'));
   	}
   	public function store(Request $request){

         if( Link::whereHash($request->hash)->first() ){

            return response()->json(['message' => 'Not stored succefully because of hash' ], 500);

         }

         if( Link::whereLink($request->link)->first() ){

            return response()->json(['message' => 'Not stored succefully because of link' ], 500);

         }


         if( $request->hash != Session::get('lastHash') ){

            return response()->json(['message' => 'Not stored succefully because of session' ], 500);

         }




   		 $link = Link::create([

   			'link' => $request->link,
            'hash' => $request->hash,
            'confirmed' => true,
   			'user_id' => Auth::id()

   		]);

   		 if($link){
   		 	return response()->json(['message' => 'Added succefully', 'item' => json_encode( $link->toArray() ) ], 200);
   		 }else{
            return response()->json(['message' => 'Not stored succefully because of database' ], 500);
          }


          

   		
   		
   	}
   	public function delete(Link $link){

   		$link->delete();

   		return response()->json(['message' => 'Deleted succefully' ], 200);
   		
   	}
}
