<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'SiteController@index');

Route::get('/register', 'SiteController@regForm');

Route::post('/register', 'SiteController@register');

Route::get('/confirm-email/{user}/{token}', 'SiteController@confirmEmail');

Route::post('/login', 'SiteController@login');

Route::get('/login', 'SiteController@loginForm');

Route::get('/unauthorized','SiteController@unauthorized');

Route::group(['middleware'=>'auth'], function() {
    Route::get('/dashboard', 'SiteController@dashboard');
    Route::get('/logout', 'SiteController@logout');

    Route::get('/user/edit/{user}', 'UserController@edit');
    Route::post('/user/edit/{user}', 'UserController@update');
    Route::post('/user/change-password/{user}', 'UserController@changePassword');

    Route::get('/participants', 'UserController@list');

    Route::post('image-cropper/upload','ImageCropperController@upload');

    Route::group(['middleware'=>'admin','prefix'=>'admin'], function() {
        Route::get('/', 'AdminController@index');
        Route::get('/users', 'AdminController@users');
        Route::get('/user/{user}', 'AdminController@user');
        Route::get('/convention/create', 'ConventionController@create');
        Route::post('/convention', 'ConventionController@store');
        Route::get('/convention/activate/{convention}', 'ConventionController@activate');

        Route::post('/election/status', 'ElectionController@changeState');
    });
});

