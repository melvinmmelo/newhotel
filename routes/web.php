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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// account
Route::get('/accounts', 'AccountController@list')->name('accounts');
Route::post('/account/create', 'AccountController@save');

// room
Route::get('/rooms', 'RoomController@list')->name('rooms');
Route::post('/room/create', 'RoomController@save');

// company
Route::get('/companies', 'CompanyController@list')->name('companies');
Route::post('/company/create', 'CompanyController@save');

// travel agent
Route::get('/travel-agents', 'TravelAgentController@list')->name('travel-agents');
Route::post('/travel-agent/create', 'TravelAgentController@save');

// reservation
Route::get('/reservations', 'ReservationController@list')->name('reservations');
Route::get('/reservation/create', 'ReservationController@create')->name('reservation-add');

Route::post('/reservation/create', 'ReservationController@save');
Route::put('/reservation/update', 'ReservationController@update');
Route::post('/reservation/room/create', 'ReservedRoomController@reserveRoom');

// transaction
Route::get('/transactions', 'TransactionController@list')->name('transactions');
Route::post('/transaction/create', 'TransactionController@save');


// promos
Route::get('/promos', 'PromoController@list')->name('promos');
Route::post('/promo/create', 'PromoController@save');

// promos
Route::get('/services', 'ServiceController@list')->name('services');
Route::post('/service/create', 'ServiceController@save');

// guest transaction
Route::post('/guest/transaction/create', 'GuestTransactionController@save');

// guest transaction
Route::post('/guest/service/create', 'GuestServiceController@save');


