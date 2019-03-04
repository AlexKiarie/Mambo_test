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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/two_factor', 'GeneralController@two_factor');
Route::get('/logged_in', 'GeneralController@logged_in');
Route::post('/login_now', 'GeneralController@login');
Route::get('/verify_token', 'GeneralController@verify_token');