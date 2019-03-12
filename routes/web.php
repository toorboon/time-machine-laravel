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

Route::get('/', 'PagesController@index');

Route::get('/createUser', 'PagesController@createUser');

Route::get('/export', 'PagesController@export');

Route::get('/grocery', 'PagesController@grocery');

Route::get('/overview', 'PagesController@overview');

Route::get('/timeMachine', 'PagesController@timeMachine');

Route::post('/timeMachine/ajaxStart', 'TimetableController@setStartDate');

Route::post('/timeMachine/ajaxStop', 'TimetableController@setStopDate');

Route::post('/timeMachine/ajaxPause', 'TimetableController@setPauseDate');

Route::post('/timeMachine/ajaxSessionCheck', 'TimetableController@checkSession');


