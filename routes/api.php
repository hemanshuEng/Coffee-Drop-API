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

Route::get('locations', 'LocationController@index')->name('location.index');
Route::post('locations', 'LocationController@store')->name('location.store');
Route::post('cashback', 'CoffeeController@amount')->name('location.store');
