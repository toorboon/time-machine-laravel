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

Route::get('/export', 'PagesController@export')->name('pages.export');

Route::get('/grocery', 'PagesController@grocery')->name('pages.grocery');

Route::get('/overview', 'PagesController@overview')->name('pages.overview');

Route::get('/timeMachine', 'PagesController@timeMachine')->name('pages.timeMachine');

Route::post('/timeMachine/ajaxStart', 'TimetableController@setStartDate')->name('start.session');

Route::post('/timeMachine/ajaxStop', 'TimetableController@setStopDate')->name('stop.session');

Route::post('/timeMachine/ajaxPause', 'TimetableController@setPauseDate')->name('pause.session');

Route::post('/timeMachine/ajaxSessionCheck', 'TimetableController@checkSession')->name('check.session');

Route::resource('sessions', 'TimetableController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
