<?php

use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'UserController@logout');
    Route::get('user', 'UserController@getAuthUser');

    Route::get('booking', 'BookingController@index');
    Route::post('booking', 'BookingController@store');
    Route::get('booking/{date}', 'BookingController@show');
    Route::put('booking/{id}', 'BookingController@update');
    Route::delete('booking/{id}', 'BookingController@destroy');
});
