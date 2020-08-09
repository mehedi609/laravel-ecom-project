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

Route::group(
  [
    'as' => 'admin.',
    'prefix' => 'admin'
  ],
  function() {
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('login', 'AdminController@login')->name('login');
    Route::post('login', 'AdminController@login')->name('login');
  }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
