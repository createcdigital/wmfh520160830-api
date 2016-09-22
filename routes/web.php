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

Route::get('/', 'IndexController@index');


Route::get('/wuser/add', 'WUserController@add');
Route::get('/wuser/get/{openid}', 'WUserController@getByOpenId');
Route::get('/wuser/update', 'WUserController@updateByShareId');
Route::get('/wuser/reset/{openid}', 'WUserController@reset');
Route::get('/wuser/upopenid', 'WUserController@updateOpenidByPhone');
Route::get('/wuser/getbyphone/{phone}', 'WUserController@getByPhone');


Route::get('/track/pv', 'TrackController@pv');
Route::get('/track/click', 'TrackController@click');
Route::get('/track/share', 'TrackController@share');

