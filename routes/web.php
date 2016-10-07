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

// Admin area
Route::get('admin', function () {
    return redirect('/admin/category');
});
Route::group([
    'namespace' => 'Admin',
    'middleware' => 'auth',
    'prefix' => 'admin',
        ], 
    function () {
        Route::get('lang/{lang?}', 'LangController@index');
        Route::resource('category', 'CategoryController');
});

Auth::routes();

Route::get('/{category_id?}', 'HomeController@index');
