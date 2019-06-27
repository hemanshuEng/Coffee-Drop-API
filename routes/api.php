<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LocationController;

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

// route for all location information and timetable
Route::get('locations', 'LocationController@index')->name('location.index');

// create new location using this api
Route::post('locations', 'LocationController@store')->name('location.store');

//cashback calculation
Route::post('cashback', 'CoffeecupController@amount')->name('coffeecup.amount');

// nearest location according to search query
Route::post('getnearestlocation', 'LocationController@find_near_location')->name('location.find');
