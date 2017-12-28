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

//=====Setting API=============================
Route::get('/getStore','Backend\Settings\SettingsController@getStore');
Route::post('/setting/save','Backend\Settings\SettingsController@store');
Route::get('/setting/list','Backend\Settings\SettingsController@list');
Route::delete('/setting/delete/{id}','Backend\Settings\SettingsController@destroy');
Route::get('/setting/getsettingbyid/{id}','Backend\Settings\SettingsController@getSettingByID');
Route::put('/setting/getsettingbyid/{id}','Backend\Settings\SettingsController@update');

//=====User Group API
//=====User Group API
Route::get('/permission','Backend\Users\UserGroupsController@getPermission');
Route::post('/user_group/save','Backend\Users\UserGroupsController@store');
Route::get('/user_group/list','Backend\Users\UserGroupsController@list');
Route::delete('/user_group/delete/{id}','Backend\Users\UserGroupsController@destroy');
Route::get('/user_group/getsettingbyid/{id}','Backend\Users\UserGroupsController@getUserByID');
Route::put('/user_group/getsettingbyid/{id}','Backend\Users\UserGroupsController@update');

//=====User API
Route::post('/user/save','Backend\Users\UsersController@store');
Route::get('/user/list','Backend\Users\UsersController@list');
Route::delete('/user/delete/{id}','Backend\Users\UsersController@destroy');
Route::get('/user/getsettingbyid/{id}','Backend\Users\UsersController@getUserByID');
Route::put('/user/getsettingbyid/{id}','Backend\Users\UsersController@update');