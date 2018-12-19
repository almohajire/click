<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\{User, Link, Ad, Clicklink};
use Auth;

use Session;
use GetSetting;
class LinkController extends Controller
{
    //
      public function confirm(Request $request, Link $link){

        if(Auth::user()->role > 0){

          $link->confirmed = true;

          $link->save();

          $user = $link->user;

          $user->in_need = true;

          $user->save();

          if( $link->confirmed ){
            return response()->json(['message' => 'Deleted succefully' ], 200);
          }else{
            return response()->json(['message' => 'Error when confirm' ], 500);
          }
          
        }else{
          return response()->json(['message' => 'Go away' ], 401);
        }


      }
      public function unconfirmed(){

        if(! Auth::user()->role > 0 ){

          return redirect()->back();
        }

        $links = Link::whereConfirmed(false)->paginate( 15 );

        return view('users.pages.links.unconfirmed', compact('links'));

      }

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

            if( $link->user->role == 0 ){

              $user->increment('number_click');

            }

            if( $user->points < intval( GetSetting::getConfig('points-to-activate') ) ){

              $user->increment('points');

              if( $user->points >= intval( GetSetting::getConfig('points-to-activate') ) ){

                $user->credit_add += intval( GetSetting::getConfig('links-to-add') );

                $user->save();

              }

            }else{

              $user->credit_add += 1/ intval( GetSetting::getConfig('how-many-clicks-to-add-1') ) ;

                

              $user->increment('points');

              $user->save();

            }

            $link->user->increment('number_clicked') ;

            if( $user->number_clicked < $user->number_click ){

              $user->in_need = true;

              $user->save();

            }


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

            $hash = sha256( $user->id. str_random(15) );

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


        //if have no mines the point he should give him to collect points
        //
        //if dont find links from users get links from the best users
        $linkClicked = Clicklink::onlyTrashed()->where('user_id', Auth::id() )->get(['link_id'])->toArray();

        $admins = User::where('role', '>' , 0)->get();
        $admins_id = User::where('role', '>' , 0)->get(['id'])->pluck('id')->toArray();
        $users_in_need = User::where('role', 0)->where('in_need', true)->get(['id'])->pluck('id')->toArray();
        $best_users = User::where('role', 0)->orderBy('points', 'desc')->take(10)->get(['id'])->pluck('id')->toArray();
        $links = Link::take(0)->get();

        $mine2points = false;

        if(Auth::user()->points >= intval( GetSetting::getConfig('points-to-activate') ) ){


          for( $i = 0; $i<=1; $i++ ) {

            if( $i == 0){
              $linksArray = Link::where('user_id','!=', Auth::id())
                ->whereConfirmed( true )
                ->whereNotIn('id', $linkClicked )
                ->whereIn('user_id', $users_in_need)
                ->whereNotIn('user_id', $admins_id)
                //->orderBy('')
                ->get(['id'])
                ->pluck('id')
                ->toArray();

            }elseif( $i == 1){

              $linksArray = Link::where('user_id','!=', Auth::id())
                ->whereConfirmed( true )
                ->whereNotIn('id', $linkClicked )
                ->whereIn('user_id', $best_users)
                ->whereNotIn('user_id', $admins_id)
                //->orderBy('')
                ->get(['id'])
                ->pluck('id')
                ->toArray(); 
            }






              if( count($linksArray) > 0 ){

                $links = Link::whereIn('id', $linksArray )->get();



                break;
              }
           }

/*

          if( count($linksArray) > 0 ){


              $links = Link::whereIn('id', $linksArray )->get();
            
          }else{



            User::where('role', 0)->where('in_need', false)->orderBy('points')->get()->each(function ($b_user, $key) use ($links, $linkClicked ) {
                
                $links->add( $b_user->links()->whereNotIn('id', $linkClicked )->first() );
            });

            if(count( $links ) == 0 ){

              $admins->each(function ($admin, $key) use ($links, $linkClicked) {
                  
                  $admin->links()->whereNotIn('id', $linkClicked )->get()->each(function ($link, $key) use ($links) {
                
                      $links->add( $link );
                  });
              });


            }

          }

          */

            
        }else{


          $admins->each(function ($admin, $key) use ($links, $linkClicked ) {
                  
              $admin->links()->whereNotIn('id', $linkClicked )->get()->each(function ($link, $key) use($links) {
                
                $links->add( $link );
            });
          });



          $mine2points = true;
        }



        //dd( $links );
        //$links->paginate( intval( GetSetting::getConfig('paginate-links') ) );

        return view('users.pages.links.mining', compact('links', 'mine2points')  );


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

         if( !$displayLink ){
            $displayLink = Ad::create([
              'link' => GetSetting::getConfig('if-all-ads-fail'),
              'user_id' => Auth::id()   
            ]);


         }
         return view('users.pages.links.surf2', compact('link', 'displayLink', 'codegen'))  ;
      }


      public function add(){

        if( Auth::user()->role > 0 || Auth::user()->credit_add >= 1 ){


        // Giving an Hash
         $hash = $this->detect();

          $link = route('links.detect', $hash); 


          return view('users.pages.links.add', compact('hash', 'link'));

        }else{
          return redirect()->back();
        }


   	}
   	public function store(Request $request){




          if( Auth::user()->role > 0 || Auth::user()->credit_add >= 1 ){



           if( Link::whereHash($request->hash)->first() ){

              return response()->json(['message' => 'Not stored succefully because of hash' ], 500);

           }
           if( Link::whereLink($request->link)->first() ){

              return response()->json(['message' => 'Not stored succefully because of link' ], 500);

           }

           if( $request->hash != Session::get('lastHash') ){

              return response()->json(['message' => 'Not stored succefully because of session' ], 500);

           }


              $linkCreation = [

                'link' => $request->link,
                'hash' => $request->hash,
                'user_id' => Auth::id()

              ];

              $linkCreation['confirmed'] = ( Auth::user()->role > 0 );

              $link = Link::create( $linkCreation );

               if($link){

                $user = Auth::user();

                if( $user->role == 0 ){

                  $user->credit_add -= 1;
                  $user->save();

                }

                
                
                return response()->json(['message' => 'Added succefully', 'item' => json_encode( $link->toArray() ) ], 200);
               }else{

                  return response()->json(['message' => 'Not stored succefully because of database' ], 500);
               }



          }else{

            return response()->json(['message' => 'You should have more points to add links' ], 401);
          }






   	}

   	public function delete( $link){

      $link = Link::findOrFail( $link );

   		$link->delete();

   		return response()->json(['message' => 'Deleted succefully' ], 200);
   		
   	}
}
