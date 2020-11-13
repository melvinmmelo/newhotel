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

    Route::get('reservation/{id}', 'UserSelectAPIController@reservation');
    Route::get('reservations', 'UserSelectAPIController@reservations');
    Route::get('reservation/{reservation}/payments', 'UserSelectAPIController@payments');
    Route::get('reservation/{reservation}/transactions/{type}', 'UserSelectAPIController@guestTransactions');
    Route::get('/checked-in/reservations', 'UserSelectAPIController@checkedInReservations');
    Route::get('accounts', 'UserSelectAPIController@accounts');
    Route::get('companies', 'UserSelectAPIController@companies');
    Route::get('travel-agents', 'UserSelectAPIController@travelAgents');
    Route::get('rooms', 'UserSelectAPIController@rooms');

    Route::get('rooms-per-type/{type}', 'UserSelectAPIController@roomsPerType');

    Route::get('transactions/{type}', 'UserSelectAPIController@transactions');
    Route::get('services', 'UserSelectAPIController@services');

    Route::get('reservation-price/{cat}/{type}', 'UserSelectAPIController@roomPriceBasedOnCatRate');

});


