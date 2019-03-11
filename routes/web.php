<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'api/v1'], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('verify/escort/{escort_id}' , 'AdminController@escortDetailsForVerification');
        Route::post('verify/escort' , 'AdminController@verifyEscort');
        Route::get('verify/all' , 'AdminController@allVerifications');


        // Transactions
        Route::get('transactions/all' , 'AdminController@allTransactions');



    });

    // Users route
    Route::group(['prefix' => 'users'], function () {
        Route::post('create' , ['as' => 'createUser', 'uses' => 'UserController@create']);
        Route::get('' , ['as' => 'allUsers', 'uses' => 'UserController@users']);
        Route::get('{id}' , ['as' => 'fetchAuser', 'uses' => 'UserController@fetchAUser']);
        Route::post('update' , ['as' => 'updateUser', 'uses' => 'UserController@updateUser']);
        Route::post('delete' , ['as' => 'updateUser', 'uses' => 'UserController@deleteUser']);
    });

    // Activation route
    Route::group(['prefix' => 'activations'], function () {
        Route::post('create' , 'ActivationController@create');
        Route::post('update' , 'ActivationController@updateActivationCode');
        Route::post('user/activate' , 'ActivationController@activateUser');
    });

    // Auth route
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login' , 'AuthController@login');
        Route::post('password_reset' , 'AuthController@passwordReset');
        Route::get('password_reset' , 'AuthController@changePassword');
    });

    // Escort route
    Route::group(['prefix' => 'escorts'], function () {

        Route::post('create' , ['as' => 'createEscort', 'uses' => 'EscortController@create']);
        Route::get('' , ['as' => 'allEscort', 'uses' => 'EscortController@escorts']);
        Route::get('all' , ['as' => 'allEscortForDisplay', 'uses' => 'EscortController@all']);
        Route::get('{rank}/all' , 'EscortController@allEscortsByRank');
        Route::get('{escort}' , ['as' => 'fetchAEscort', 'uses' => 'EscortController@escortDetails']);
        Route::post('update' , ['as' => 'updateEscort', 'uses' => 'EscortController@updateEscort']);
        Route::get('details/feed' , ['as' => 'feed', 'uses' => 'EscortController@getEscortsForHomepage']);
        Route::get('details/dashboard' , ['as' => 'escortDetailsForDashboard', 'uses' => 'EscortController@escortDetailsForDashboard']);
    });

    // Service route
    Route::group(['prefix' => 'services'], function () {
        Route::post('create' , ['as' => 'createService', 'uses' => 'ServiceController@create']);
        Route::get('' , ['as' => 'allServices', 'uses' => 'ServiceController@services']);
        Route::post('update' , ['as' => 'updateEscort', 'uses' => 'ServiceController@updateServices']);
    });

    // Verifications route
    Route::group(['prefix' => 'verifications'], function () {
        Route::post('create' , 'VerificationController@create');
        Route::post('escort/verify' , 'VerificationController@verifyEscort');
    });

    // Verifications route
    Route::group(['prefix' => 'features'], function () {
        Route::post('create' , 'FeatureController@create');
        Route::get('all' , 'FeatureController@all');
    });

    // Verifications route
    Route::group(['prefix' => 'transactions'], function () {
        Route::post('create' , 'TransactionController@create');
    });

    // Verifications route
    Route::group(['prefix' => 'reviews'], function () {
        Route::post('create' , 'ReviewController@create');
    });

    // Verifications route
    Route::group(['prefix' => 'images'], function () {
        Route::post('create' , 'ImageController@create');
        Route::post('update' , 'ImageController@update');
    });

    // Verifications route
    Route::group(['prefix' => 'videos'], function () {
        Route::post('create' , 'VideoController@create');
        Route::post('update' , 'VideoController@update');
    });
});
