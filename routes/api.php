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

//FrontEnd
//=====Customer Account Register API
Route::post('/customer/register','FrontEnd\Account\RegisterController@store');
Route::get('/customer/test','FrontEnd\Account\LoginController@test');
Route::post('/customer/login','FrontEnd\Account\LoginController@AuthLogin');
Route::get('/customer/get','FrontEnd\Account\LoginController@getPasswordCustomer');

//BackEnd

//=====Setting API=============================
Route::get('/getStore','Backend\Settings\SettingsController@getStore');
Route::post('/setting/save','Backend\Settings\SettingsController@store');
Route::get('/setting/list','Backend\Settings\SettingsController@list');
Route::delete('/setting/delete/{id}','Backend\Settings\SettingsController@destroy');
Route::get('/setting/getsettingbyid/{id}','Backend\Settings\SettingsController@getSettingByID');
Route::put('/setting/update/{id}','Backend\Settings\SettingsController@update');

//=====User Group API

Route::get('/getUsers','Backend\Users\UserGroupsController@getUsers');
Route::get('/permission','Backend\Users\UserGroupsController@getPermission');
Route::post('/user_group/save','Backend\Users\UserGroupsController@store');
Route::get('/user_group/list','Backend\Users\UserGroupsController@list');
Route::delete('/user_group/delete/{id}','Backend\Users\UserGroupsController@destroy');
Route::get('/user_group/getusergroupbyid/{id}','Backend\Users\UserGroupsController@getUserByID');
Route::put('/user_group/update/{id}','Backend\Users\UserGroupsController@update');

//=====User API
Route::get('/user/list','Backend\Users\UsersController@list');
Route::get('/user/checkUser/{username}','Backend\Users\UsersController@checkUser');
Route::get('/user/checkEmail/{email}','Backend\Users\UsersController@checkEmail');
Route::post('/user/save','Backend\Users\UsersController@store');
Route::delete('/user/delete/{id}','Backend\Users\UsersController@destroy');
Route::get('/user/getuserbyid/{id}','Backend\Users\UsersController@getUserByID');
Route::put('/user/update/{id}','Backend\Users\UsersController@update');
