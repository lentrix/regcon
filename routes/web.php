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

Route::get('/contact-us', function(){
    return view('pages.contact-us');
});

Route::get('/about', function(){
    return view('pages.about');
});

Route::group(['middleware'=>'auth'], function() {
    Route::get('/dashboard', 'SiteController@dashboard');
    Route::get('/logout', 'SiteController@logout');

    Route::post('/submit-proof-of-payment','ParticipationController@submitProofOfPayment');

    Route::get('/user/edit/{user}', 'UserController@edit');
    Route::post('/user/edit/{user}', 'UserController@update');
    Route::post('/user/change-password/{user}', 'UserController@changePassword');

    Route::get('/participants', 'UserController@list');

    Route::post('image-cropper/upload','ImageCropperController@upload');

    Route::get('/election', 'ElectionController@home');
    Route::post('/election/search-member', 'ElectionController@searchMember');
    Route::post('/election/nomination', 'ElectionController@nominate');
    Route::get('/election/check-nomination', 'ElectionController@checkNomination');
    Route::post('/election/nomination-response', 'ElectionController@nominationResponse');
    Route::get('/election/candidates', 'ElectionController@getCandidates');
    Route::get('/election/voted-at', 'ElectionController@getVotedAt');
    Route::post('/election/submit-vote', 'ElectionController@submitVote');
    Route::get('/election/voted-candidates','ElectionController@getVotedCandidates');
    Route::get('/election/results', 'ElectionController@getElectionResults');

    Route::get('/raffle', 'RaffleController@userIndex');

    Route::group(['middleware'=>'admin','prefix'=>'admin'], function() {
        Route::get('/', 'AdminController@index');
        Route::get('/users', 'AdminController@users');
        Route::get('/user/{user}', 'AdminController@user');

        Route::post('/participation/add', 'AdminController@registerParticipant');
        Route::put('/participation','AdminController@updateParticipant');

        Route::get('/convention/create', 'ConventionController@create');
        Route::post('/convention', 'ConventionController@store');
        Route::get('/convention/activate/{convention}', 'ConventionController@activate');

        Route::get('/election', 'ElectionController@index');
        Route::post('/election/status', 'ElectionController@changeState');
        Route::post('/election/add-candidate', 'ElectionController@addCandidate');
        Route::post('/election/revoke-candidate', 'ElectionController@revokeCandidate');

        Route::get('/raffles', 'RaffleController@index');
        Route::get('/raffles/new-item', 'RaffleController@create');
        Route::post('/raffles/new-item', 'RaffleController@store');
        Route::get('/raffles/edit/{item}', 'RaffleController@edit');
        Route::put('/raffles/edit/{item}', 'RaffleController@update');
        Route::get('/raffles/draw', 'RaffleController@draw');
        Route::get('/raffles/items', 'RaffleController@getItems');
        Route::get('/raffles/draws', 'RaffleController@drawWinners');
        Route::get('/raffles/participants/{exclusive}', 'RaffleController@getParticipants');
        Route::post('/raffles/commit', 'RaffleController@commit');

        Route::get('/proofs', 'ParticipationController@showProofs');
        Route::post('/verify-proof/{proof}', 'ParticipationController@verifyPayment');
    });
});

