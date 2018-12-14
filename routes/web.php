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
});

Route::get('/test', 'TestController@test')->name('test');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

	Route::get('/home', 'HomeController@index')->name('users.home');

	Route::group(['prefix' => 'rightbar'], function () {

		Route::post('/theme-color/{color}', 'RightBarController@changeColor')->name('colors.change');

	});


	Route::group(['prefix' => 'report'], function () {

		Route::get('/', 'ReportController@index')->name('reports.index');

		Route::post('/lake-admin-links', 'ReportController@lakeOfAdminLinks')->name('reports.lake-admin-links');

	});

	

	Route::group(['middleware' => ['admin'],'prefix' => 'admin'], function () {


		Route::group(['prefix' => 'link'], function () {

			Route::get('/unconfirmed', 'LinkController@unconfirmed')->name('links.unconfirmed');

			Route::post('/confirm/{link}', 'LinkController@confirm')->name('links.confirm');
		});

/**********************Configs*********************************/
			Route::get('/configs', 'ConfigController@index')->name('configs.index');
			Route::post('/configs/store', 'ConfigController@store')->name('configs.store');
			Route::get('/configs/add', 'ConfigController@add')->name('configs.add');
			Route::post('/configs/store-config', 'ConfigController@storeConfig')->name('configs.store-config');

		

	});





	Route::group(['prefix' => 'link'], function () {

		Route::get('/mine', 'LinkController@mine')->name('links.mine');

		Route::get('/mining', 'LinkController@mining')->name('links.mining');

		//Route::get('/detect/{random?}', 'LinkController@detect')->name('links.detect');


		Route::get('/detect/{random?}', 'LinkController@detect')->name('links.detect')->where('random', '(.*)');


		Route::post('/check/{user}/{link}', 'LinkController@check')->name('links.check');


		Route::get('/surf', 'LinkController@surf')->name('links.surf');

		Route::get('/surf2/{link}', 'LinkController@surf2')->name('links.surf2');

	  Route::get('/add', 'LinkController@add')->name('links.add');
	  Route::post('/store', 'LinkController@store')->name('links.store');
	  Route::post('/delete', 'LinkController@delete')->name('links.delete');


		Route::get('/send-originale', 'LinkController@originaleSend')->name('links.originale-send');

		Route::post('/originale', 'LinkController@originale')->name('links.originale');




	});


});


//Examples


Route::get('/dashbord', 'DashbordController@index')->name('dashbords.examples');




