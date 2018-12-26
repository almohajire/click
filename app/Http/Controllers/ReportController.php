<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{User, Link, Ad, Clicklink, Report};
use Auth;

use Session;
use GetSetting;

class ReportController extends Controller
{


	public function delete(Request $request,$report){

        $report = Report::findOrFail( $report->id );
        
        $report->delete();

        if( ! Report::findOrFail( $report->id )){

            return response()->json(['message' => 'Succefully reported' ], 200);
            
        }else{
            return response()->json(['message' => 'Please try again' ], 500);
        }
    }


    public function index(){

		$items = Report::latest()->paginate(20);

		return view('users.pages.admin.reports' ,compact('items'));
	}
    public function lakeOfAdminLinks(Request $request){

    	$user = Auth::user();


    	$report = Report::create([
    		'user_id' => $user->id,
    		'message' => 'Lake of admin links please add links now !'
    	]);



    	if( $report ){

    		if( $user->points < intval( GetSetting::getConfig('points-to-activate') ) ){

		    	$user->points = intval( GetSetting::getConfig('points-to-activate') );

		    	$user->credit_add += intval( GetSetting::getConfig('links-to-add') );

		        $user->save();

    		}



	        return response()->json(['message' => 'Succefully reported' ], 200);

    	}else{

    		return response()->json(['message' => 'Please try again' ], 500);

    	}

    	







        



    }

    public function lakeOfAdminLinks2(Request $request){

        $user = Auth::user();


        $report = Report::create([
            'user_id' => $user->id,
            'message' => 'Lake of admin links please add links now !'
        ]);



        if( $report ){

            return response()->json(['message' => 'Succefully reported' ], 200);

        }else{

            return response()->json(['message' => 'Please try again' ], 500);

        }


    }


    public function lakeOfLinks(Request $request){

        $user = Auth::user();


        $report = Report::create([
            'user_id' => $user->id,
            'message' => 'Lake of links please active more links now !'
        ]);



        if( $report ){

            return response()->json(['message' => 'Succefully reported' ], 200);

        }else{

            return response()->json(['message' => 'Please try again' ], 500);

        }


    }



}
