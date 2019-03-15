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

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('permission', 'Admin\PermissionController');
    });
});


// Vue application router 

Route::get('/{admin?}', function () {
    return view('dashboard');
})->where('admin', '[\/\.\w\-]+');