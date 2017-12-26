<?php

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

// Route::post('/login','AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//BackEnd

Route::get('/getStore','Backend\Settings\SettingsController@getStore');
Route::post('/setting/save','Backend\Settings\SettingsController@Store');
Route::get('/setting/list','Backend\Settings\SettingsController@list');
Route::delete('/setting/delete/{id}','Backend\Settings\SettingsController@destroy');
