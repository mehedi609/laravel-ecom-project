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
    Route::get('logout', 'AdminController@logout')->name('logout');
    Route::get('settings', 'AdminController@settings')->name('settings');
    Route::get('check-password', 'AdminController@checkPassword')->name('check-password');
    Route::get('update-password', 'AdminController@updatePassword')->name('update.password');
    Route::put('update-password', 'AdminController@updatePassword')->name('update.password');

    // Category Routes (Admin)
    Route::resource('category', 'CategoryController')->except('show');

    // Product Routes (Admin)
    Route::resource('product', 'ProductController')->except('show');
  }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
