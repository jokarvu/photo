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

Auth::loginUsingId(1);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('auth/login', 'AuthController@login');
    Route::get('auth/register', 'AuthController@create');
    Route::post('auth/register', 'AuthController@register');
    Route::get('auth/logout', 'AuthController@logout')->middleware('authorization');
    Route::get('auth/dashboard', 'AuthController@dashboard')->middleware('authorization');
    Route::get('auth/user', 'AuthController@user')->middleware('authorization');
    Route::get('auth/guest', 'AuthController@guest');
    Route::group(['prefix' => 'admin', 'middleware' => ['authorization']], function () {
        Route::resource('permission', 'Admin\PermissionController');
        Route::resource('user', 'Admin\UserController');
        Route::resource('role', 'Admin\RoleController');
        Route::resource('tag', 'Admin\TagController');
        Route::resource('location', 'Admin\LocationController');
    });
    Route::resource('image', 'ImageController');
    Route::resource('option', 'OptionController');
    Route::resource('review', 'ReviewController');
    Route::resource('coupon', 'CouponController')->middleware('authorization');
    Route::resource('message', 'MessageController')->middleware('authorization');
    Route::resource('invoice', 'InvoiceController')->middleware('authorization');
});


// Vue application router 

Route::get('/{admin?}', function () {
    return view('dashboard');
})->where('admin', '[\/\.\w\-]+');