<?php

use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('reservations', 'SelectAPIController@reservations');
    Route::get('accounts', 'SelectAPIController@accounts');
    Route::get('companies', 'SelectAPIController@companies');
    Route::get('travel-agents', 'SelectAPIController@travelAgents');
    Route::get('rooms', 'SelectAPIController@rooms');

    Route::get('reserved-rooms/{id}', 'SelectAPIController@getReservedRooms');

    Route::get('transactions', 'SelectAPIController@transactions');

    Route::get('promos', 'SelectAPIController@promos');
    Route::get('services', 'SelectAPIController@services');
});


