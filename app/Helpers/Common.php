<?Php
namespace App\Helpers\Common;
use File;
use App\Helpers\Config\Setting;

use App\{

    User,
 
};
use Session;
use Carbon;
use Auth;
//TODO
/*
Add the Transport field to students
Add the Year life cycle
*/
class Pics {

    public static function storeFile( $file = '', $dir = '' ){
        $imgName = $file->getClientOriginalName();
        $imgAndTime = time() . '_' . $imgName ;
        $file->move( base_path().'/public/images/'. $dir .'/', $imgAndTime );
        return $imgAndTime;
    }
    public static function storeCompareFile($slug = '', $dir = '', $file = '' ,$request){
    	$imgName = $request->file( $slug )->getClientOriginalName();
	        if( file_exists( base_path().'/public/images/'. $dir .'/'.$file ) ){
	            File::delete( base_path().'/public/images/'. $dir .'/' . $file );
	        }
        $imgAndTime = time() . '_' . $imgName ;
        $request->file( $slug )->move( base_path().'/public/images/'. $dir .'/', $imgAndTime );
	    return $imgAndTime;
    }
    public static function ifImg($place, $varImg ){
        if( $varImg == '' || $varImg == null || !file_exists( base_path().'/public/images/'. $place .'/'.$varImg )  ){
            return asset('/images/config/'. Setting::getConfig( 'no-image' ) );
        }else{
            return asset('/images/'.$place.'/'. $varImg );
        }
    }
}