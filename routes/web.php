<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/test', 'TestController@test')->name('test');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

	Route::get('/home', 'HomeController@index')->name('users.home');

	Route::group(['prefix' => 'rightbar'], function () {

		Route::post('/theme-color/{color}', 'RightBarController@changeColor')->name('colors.change');
		Route::post('/shorten-open', 'RightBarController@shortenOpen')->name('shortens.open');

	});


	Route::group(['prefix' => 'report'], function () {

		

		Route::post('/lake-admin-links', 'ReportController@lakeOfAdminLinks')->name('reports.lake-admin-links');

		Route::post('/lake-admin-links2', 'ReportController@lakeOfAdminLinks2')->name('reports.lake-admin-links2');

		Route::post('/lake-of-links', 'ReportController@lakeOfLinks')->name('reports.lake-of-links');

	});

	

	Route::group(['middleware' => ['admin'],'prefix' => 'admin'], function () {


		Route::group(['prefix' => 'link'], function () {

			Route::get('/unconfirmed', 'LinkController@unconfirmed')->name('links.unconfirmed');

			Route::post('/confirm/{link}', 'LinkController@confirm')->name('links.confirm');
			Route::post('/delete/{link}', 'LinkController@delete')->name('links.delete');


			Route::get('/exchange', 'LinkController@exchange')->name('links.exchange');


			Route::group(['prefix' => 'report'], function () {

				

				Route::get('/', 'ReportController@index')->name('reports.index');

				Route::post('/delete/{report}', 'ReportController@delete')->name('reports.delete');

			});


			Route::group(['prefix' => 'configs'], function () {

				Route::get('/', 'ConfigController@index')->name('configs.index');
				Route::post('/store', 'ConfigController@store')->name('configs.store');
				Route::get('/add', 'ConfigController@add')->name('configs.add');
				Route::post('/store-config', 'ConfigController@storeConfig')->name('configs.store-config');

			});

			Route::group(['prefix' => 'ads'], function () {

				Route::get('/', 'AdController@index')->name('ads.index');
				Route::post('/store', 'AdController@store')->name('ads.store');
				Route::get('/add', 'AdController@add')->name('ads.add');
			});



			
		});


		Route::group(['prefix' => 'catcher'], function () {

			Route::get('/logs/{user}', 'CatcherController@logs')->name('catchers.logs');

		});

/**********************Configs*********************************/
			

		

	});





	Route::group(['prefix' => 'link'], function () {

		Route::get('/mine', 'LinkController@mine')->name('links.mine');

		Route::get('/mining', 'LinkController@mining')->name('links.mining');

		Route::get('/points-mining', 'LinkController@miningPoints')->name('links.points_mining');
		//Route::get('/detect/{random?}', 'LinkController@detect')->name('links.detect');


		Route::get('/detect/{random?}', 'LinkController@detect')->name('links.detect')->where('random', '(.*)');


		Route::post('/check/{user}/{link}', 'LinkController@check')->name('links.check');
		
		Route::post('/exchange-check/{user}/{link}', 'LinkController@exchangeCheck')->name('links.exchange-check');

		Route::get('/surf2/{link}', 'LinkController@surf2')->name('links.surf2');

	  Route::get('/add', 'LinkController@add')->name('links.add');
	  Route::post('/store', 'LinkController@store')->name('links.store');
	  


		Route::get('/send-originale', 'LinkController@originaleSend')->name('links.originale-send');

		Route::post('/originale', 'LinkController@originale')->name('links.originale');




	});


});


//Examples


Route::get('/dashbord', 'DashbordController@index')->name('dashbords.examples');




