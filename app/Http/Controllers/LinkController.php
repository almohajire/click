<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\{User, Link, Ad, Clicklink};
use Auth;
use Carbon\Carbon;
use Session;
use GetSetting;
use App\Helpers\Common\Holder;


class LinkController extends Controller
{
    //
      public function confirm(Request $request, Link $link){

        if(Auth::user()->role > 0){

          $link->confirmed = true;

          $link->save();

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

         $codegen = $request->codegen;

         //Hna fin ymkan ykoun mchkiil

         $discoveredlink = $user->discoverdLinks()->where('link_id', $link->id)->first();


         if( $discoveredlink ){

          //dd( $discoveredlink->pivot->codegen , $codegen );


         if( $discoveredlink->pivot->codegen == $codegen){


            //dd($discoveredlink->pivot->id);
            //return response()->json(['message' => $discoveredlink->pivot->id ], 200);



            $clicklink = Clicklink::withTrashed()->where( 'id', $discoveredlink->pivot->id )->firstOrFail();

            if( $clicklink->deleted_at){

              if($clicklink->deleted_at > Carbon::now()/*->subDays( */->subMinute( intval( 
                                          GetSetting::getConfig('repeate-link-in-days') 
                                                                                          ) ) ){


                return response()->json(['message' => 'Not stored succefully because of time' ], 500);

                
              }

            }



            $clicklink->delete();



            




            if( $link->user->role == 0 ){


              if( $user->points < intval( GetSetting::getConfig('points-to-activate') ) ){

                $user->increment('points');

                if( $user->points >= intval( GetSetting::getConfig('points-to-activate') ) ){

                  $user->credit_add += intval( GetSetting::getConfig('links-to-add') );


                }


                

              }else{

                $user->credit_add += 1/ intval( GetSetting::getConfig('how-many-clicks-to-add-1') ) ;

                $user->increment('points');


              }


              ///////////////////

              
              $user->increment('number_click');
                
              $link->user->increment('number_clicked');
                

              $owner = User::find( $link->user->id );

              $owner->in_need = ( $owner->number_click > $owner->number_clicked );

              $owner->save();



            }else{

              

              if( $user->points < intval( GetSetting::getConfig('points-to-activate') ) ){

                $user->increment('points');

                if( $user->points >= intval( GetSetting::getConfig('points-to-activate') ) ){

                  $user->credit_add += intval( GetSetting::getConfig('links-to-add') );


                }

              }else{

                $user->points += intval( GetSetting::getConfig('points-booster')  ) ;


                $user->credit_add += (1/ intval( GetSetting::getConfig('how-many-clicks-to-add-1') )  ) * intval( GetSetting::getConfig('credit-add-booster')  ) ;

                $user->increment('number_click');

              }
                
              $link->user->increment('number_clicked') ;
              

            }


            $user->save();


            ///////////

            $user = User::find( $user->id );


            $user->in_need = ( $user->number_click > $user->number_clicked );

            $user->save();

            $link->increment('clicked') ;


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

            $hash = md5( $user->id. str_random(15) );

            Session::put('lastHash', $hash);

            return $hash;

         }else{

            $link = Link::whereHash($detect)->first();

            if( $link ){

                $way = '';

              if( Auth::user()->is_admin && $link->user->role > 0  ){

                $way = 'admin2admin';

              }elseif( Auth::user()->is_admin && $link->user->role == 0 ){

                $way = 'admin2user';

              }elseif( Auth::user()->role == 0 && $link->user->is_admin ){

                $way = 'user2admin';

              }else{

                $way = 'user2user';

              }

              //dd( $way);

               

              return view('users.pages.links.check', compact('link', 'way'));

            }else{


               return 'Sirbhalk';
            }

            

         }


         
      }

      public function miningPoints(){

        if(Auth::user()->is_admin){

          return redirect()->route('users.home');

        }

        $poping = null;

        $linkClicked = Clicklink::onlyTrashed()


          ->where( 
            'deleted_at', '>', 
            Carbon::now()
            //->subDays( 
              ->subMinute(
              intval( 
              GetSetting::getConfig('repeate-link-in-days') 
              ) 
            ) 
          )
          ->where('user_id', Auth::id() )
          ->get(['link_id'])->toArray();


        $admins = User::where('role', '>' , 0)->get();
        $admins_id = User::where('role', '>' , 0)->get(['id'])->pluck('id')->toArray();
        $users_in_need = User::where('role', 0)->where('in_need', true)->get(['id'])->pluck('id')->toArray();
        $best_users = User::where('role', 0)->orderBy('points', 'desc')->take(10)->get(['id'])->pluck('id')->toArray();
        $links = Link::take(0)->get();

        $mine2points = true;
        $from = 'miningPoints';


        $admins->each(function ($admin, $key) use ($links, $linkClicked ) {
                
            $admin->links()->whereNotIn('id', $linkClicked )->get()->each(function ($link, $key) use($links) {
              
              $links->add( $link );
          });
        });


        return view('users.pages.links.mining', compact('links', 'mine2points', 'from', 'poping')  );





      }

      public function exchangeCheck(Request $request, User $user, Link $link){

         $codegen = $request->codegen;

         //Hna fin ymkan ykoun mchkiil

         $discoveredlink = $user->discoverdLinks()->where('link_id', $link->id)->first();


         if( $discoveredlink ){

          //dd( $discoveredlink->pivot->codegen , $codegen );


         if( $discoveredlink->pivot->codegen == $codegen){


            //dd($discoveredlink->pivot->id);
            //return response()->json(['message' => $discoveredlink->pivot->id ], 200);



            $clicklink = Clicklink::withTrashed()->where( 'id', $discoveredlink->pivot->id )->firstOrFail();

            if( $clicklink->deleted_at){

              if($clicklink->deleted_at > Carbon::now()/*->subDays( */->subMinute( intval( 
                                          GetSetting::getConfig('repeate-link-in-days') 
                                                                                          ) ) ){


                return response()->json(['message' => 'Not stored succefully because of time' ], 500);

                
              }

            }



            $clicklink->delete();




            if( $link->user->role == 0 ){

              $user->increment('points');


              ///////////////////

                
              $link->user->increment('number_clicked');
                

              $owner = User::find( $link->user->id );

              $owner->in_need = ( $owner->number_click > $owner->number_clicked );

              $owner->save();



            }else{

              $user->increment('points');

              $user->increment('number_click');
                
              $link->user->increment('number_clicked') ;


              $owner = User::find( $link->user->id );

              $owner->in_need = ( $owner->number_click > $owner->number_clicked );

              $owner->save();
              

            }


            $user->save();


            ///////////

            $user = User::find( $user->id );


            $user->in_need = ( $user->number_click > $user->number_clicked );

            $user->save();

            $link->increment('clicked') ;


            return response()->json(['message' => 'Codegen is correct' ], 200);

         }else{

            return response()->json(['message' => 'Not stored succefully because of codegen' ], 500);

         }


         }else{

            return response()->json(['message' => 'Not stored succefully because of link' ], 500);

         }

   
         
      }


      public function exchange(){

        if(!Auth::user()->is_admin){

          return redirect()->route('users.home');

        }

        $linkClicked = Clicklink::onlyTrashed()

          ->where( 
            'deleted_at', '>', 
            Carbon::now()
            //->subDays( 
              ->subMinute(
              intval( 
              GetSetting::getConfig('repeate-link-in-days') 
              ) 
            ) 
          )
          ->where('user_id', Auth::id() )
          ->get(['link_id'])->toArray();
        $admins = User::where('role', '>' , 0)->get();
        $admins_id = User::where('role', '>' , 0)->get(['id'])->pluck('id')->toArray();
        $admins_in_need = User::where('role', '>' , 0)->where('in_need', true)->get(['id'])->pluck('id')->toArray();
        $best_admins = User::where('role', '>' , 0)->orderBy('points', 'desc')->take(10)->get(['id'])->pluck('id')->toArray();
        $links = Link::take(0)->get();


        $admins_in_need = User::where('role','>', 0)->where('in_need', true)->get(['id'])->pluck('id')->toArray();


        for( $i = 0; $i<=1; $i++ ) {

          if( $i == 0){
            $linksArray = Link::where('user_id','!=', Auth::id())
              ->whereConfirmed( true )
              ->whereNotIn('id', $linkClicked )
              ->whereIn('user_id', $admins_in_need)
              ->whereIn('user_id', $admins_id)
              //->orderBy('')
              ->inRandomOrder()
              ->get(['id'])
              ->pluck('id')

              ->toArray();

          }elseif( $i == 1){

            $linksArray = Link::where('user_id','!=', Auth::id())
              ->whereConfirmed( true )
              ->whereNotIn('id', $linkClicked )
              ->whereIn('user_id', $best_admins)
              ->whereIn('user_id', $admins_id)
              //->orderBy('')
              ->inRandomOrder()
              ->get(['id'])
              ->pluck('id')
              ->toArray(); 
          }



            if( count($linksArray) > 0 ){

              $links = Link::whereIn('id', $linksArray )->get();



              break;
            }
         }


        return view('users.pages.links.exchange', compact('links') );

      }

      public function mining(){

        if(Auth::user()->is_admin){

          return redirect()->route('users.home');

        }


        //if have no mines the point he should give him to collect points
        //
        //if dont find links from users get links from the best users
// <<<<<<< HEAD
// =======

// >>>>>>> dc391d395815e9b7d440de08a75dc994668c8d27


        $linkClicked = Clicklink::onlyTrashed()


          ->where( 
            'deleted_at', '>', 
            Carbon::now()
            //->subDays( 
              ->subMinute(
              intval( 
              GetSetting::getConfig('repeate-link-in-days') 
              ) 
            ) 
          )
          ->where('user_id', Auth::id() )
          ->get(['link_id'])->toArray();


        $admins = User::where('role', '>' , 0)->get();
        $admins_id = User::where('role', '>' , 0)->get(['id'])->pluck('id')->toArray();
        $users_in_need = User::where('role', 0)->where('in_need', true)->get(['id'])->pluck('id')->toArray();
        $best_users = User::where('role', 0)->orderBy('points', 'desc')->take(10)->get(['id'])->pluck('id')->toArray();
        $links = Link::take(0)->get();

        //POP UP

        if( Auth::user()->points >= intval( GetSetting::getConfig('points-to-activate') ) ){

          $poping = Clicklink::where('user_id', Auth::id() )->whereNotIn('link_id', $linkClicked )->whereIn('user_id', $admins_id )->first();

        }else{

          $poping = null;

        }


        

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
                ->inRandomOrder()
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
                ->inRandomOrder()
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
        $from = 'mining';

        return view('users.pages.links.mining', compact('links', 'mine2points','from','poping')  );


      }

      public function mine(){

        $links = Auth::user()->links()->paginate(20);

         return view('users.pages.links.mine', compact('links')  );
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

         $displayLink;
         
         

         //vip_type
         // that assemble some ads if there are with considerence of the limit of time and vip type??
         $array2shake = [];
         $displayLinkLev1 = Ad::where('vip_type', 0)->where('start', '<', Carbon::now())->where('end', '>', Carbon::now())->inRandomOrder()->first();
         if( $displayLinkLev1 ){  $array2shake[] = $displayLinkLev1->id; }
         $displayLinkLev2 = Ad::where('vip_type', 1)->where('start', '<', Carbon::now())->where('end', '>', Carbon::now())->inRandomOrder()->first();
         if( $displayLinkLev2 ){  
            $array2shake[] = $displayLinkLev2->id;
            $array2shake[] = $displayLinkLev2->id; 
         }
         $displayLinkLev3 = Ad::where('vip_type', 2)->where('start', '<', Carbon::now())->where('end', '>', Carbon::now())->inRandomOrder()->first();
         if( $displayLinkLev3 ){
           $array2shake[] = $displayLinkLev3->id;
           $array2shake[] = $displayLinkLev3->id; 
           $array2shake[] = $displayLinkLev3->id;
         }

         //if there is no item in the array there is no prob

         if( !empty( $array2shake )  ){

          //This is a part of the error

          //ii there is some item we shake it to take one randomely

          //but displayLink return 0 // there is no id == 0

          //we solve it :D

          $displayLink = Ad::findOrFail( array_rand( $array2shake, 1 ) );

         }else{

          //we create one

            $displayLink = Ad::create([
              //you notice the config?
              'link' => GetSetting::getConfig('if-all-ads-fail'),
              'user_id' => User::where('role', 1)->first()->id,
              'vip_type' => 2,
              'start' => Carbon::now(),
              'end' => Carbon::now()->addMonth(),
            ]);

         }

         $displayLink->increment('displayed');

         return view('users.pages.links.surf2', compact('link', 'displayLink', 'codegen'))  ;
      }


      public function add(){

        if( Auth::user()->is_admin > 0 || Auth::user()->credit_add >= 1 ){


        // Giving an Hash
         $hash = $this->detect();

          $link = route('links.detect', $hash); 


          return view('users.pages.links.add', compact('hash', 'link'));

        }else{
          return redirect()->back();
        }


   	}
   	public function store(Request $request){




          if( Auth::user()->is_admin || Auth::user()->credit_add >= 1 ){



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

              if(Auth::user()->role > 0){

                $arrLK = array_keys( Holder::linkLevel() );

                $arrLL = $arrLK;

                $linkCreation['level'] = end( $arrLL );

              }

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
