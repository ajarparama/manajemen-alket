<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware'=>['auth']], function () { 
	Route::get('/', function () {
	    return redirect('/home');
	});

	Route::resource('ppat', 'PPATController');
	Route::resource('lapppat', 'LapPPATController');
	Route::resource('alket', 'AlketController');
	Route::resource('mediamassa', 'MediaMassaController');
	Route::resource('siup', 'SIUPController');
	Route::get('cetak-laporan', 'LapTrwController@index')->name('cetak-laporan');

	Route::get('setting', 'SettingController@index');

	Route::get('monitoring', 'MonitoringController@monppat');

	Route::get('/home', 'HomeController@index');
});
	Auth::routes();
