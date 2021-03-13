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

Route::group(['middleware'=>'auth'], function() {
    Route::get('/dashboard', 'SiteController@dashboard');
    Route::get('/logout', 'SiteController@logout');

    Route::get('/user/edit/{user}', 'UserController@edit');
    Route::post('/user/edit/{user}', 'UserController@update');
    Route::post('/user/change-password/{user}', 'UserController@changePassword');

    Route::get('/participants', 'UserController@list');

    Route::get('/elections', 'ElectionController@index');

    Route::post('image-cropper/upload','ImageCropperController@upload');

    Route::get('/search-participants/{key}', 'ElectionAPIController@participants');
    Route::post('/nominate', 'ElectionAPIController@nominate');
    Route::get('/check-nominated', 'ElectionAPIController@checkNominated');
});

