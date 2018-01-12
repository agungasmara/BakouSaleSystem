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
Route::get('/setting/item/{id}','Backend\Settings\SettingsController@item');//use to get all config item to put into dropdown list in setting edit form
Route::delete('/setting/delete/{id}','Backend\Settings\SettingsController@destroy');
Route::get('/setting/getsettingbyid/{id}','Backend\Settings\SettingsController@getSettingByID');
Route::put('/setting/update/{id}','Backend\Settings\SettingsController@update');

//=====User Group API

Route::get('/getUsers','Backend\UserGroups\UserGroupsController@getUsers');
Route::get('/permission','Backend\UserGroups\UserGroupsController@getPermission');
Route::get('/user_group/checkIfExisted/{field}/{value}','Backend\UserGroups\UserGroupsController@checkIfExisted');
Route::post('/user_group/save','Backend\UserGroups\UserGroupsController@store');
Route::get('/user_group/list','Backend\UserGroups\UserGroupsController@list');
Route::delete('/user_group/delete/{id}','Backend\UserGroups\UserGroupsController@destroy');
Route::get('/user_group/getusergroupbyid/{id}','Backend\UserGroups\UserGroupsController@getUserByID');
Route::put('/user_group/update/{id}','Backend\UserGroups\UserGroupsController@update');

//=====User API
Route::get('/user/list','Backend\Users\UsersController@list');
Route::get('/user/checkIfExisted/{field}/{value}','Backend\Users\UsersController@checkIfExisted');
Route::post('/user/save','Backend\Users\UsersController@store');
Route::delete('/user/delete/{id}','Backend\Users\UsersController@destroy');
Route::get('/user/getuserbyid/{id}','Backend\Users\UsersController@getUserByID');
Route::put('/user/update/{id}','Backend\Users\UsersController@update');