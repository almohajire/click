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


class Holder {

/*

                        

                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>

 */
        public static function template_colors( $item = null ){
            $colors = [
                [
                    'name' => 'Red',
                    'slug' => 'red'
                ],
                [
                    'name' => 'Pink',
                    'slug' => 'pink'
                ],
                [
                    'name' => 'Purple',
                    'slug' => 'purple'
                ],
            ];
            if( $item === null){
                return $colors;
            }else{
                return $colors[$item];
            }
        }

/*
        public static function template_colors(){

            return app()->make('stdClass', [
                [
                    'name' => 'Red',
                    'slug' => 'red'
                ]
            ]);

        }
*/

}