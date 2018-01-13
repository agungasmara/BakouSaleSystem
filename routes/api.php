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
Route::post('/settings/save','Backend\Settings\SettingsController@store');
Route::get('/settings/list','Backend\Settings\SettingsController@list');
Route::get('/settings/item/','Backend\Settings\SettingsController@item');//use to get all config item to put into dropdown list in setting edit form
Route::delete('/settings/delete/{id}','Backend\Settings\SettingsController@destroy');
Route::get('/settings/getsettingbyid/{id}','Backend\Settings\SettingsController@getSettingByID');
Route::put('/settings/update/{id}','Backend\Settings\SettingsController@update');

//=====User Group API

Route::get('/getUsers','Backend\UserGroups\UserGroupsController@getUsers');
Route::get('/permission','Backend\UserGroups\UserGroupsController@getPermission');
Route::get('/users_group/checkIfExisted/{field}/{value}','Backend\UserGroups\UserGroupsController@checkIfExisted');
Route::post('/users_group/save','Backend\UserGroups\UserGroupsController@store');
Route::get('/users_group/list','Backend\UserGroups\UserGroupsController@index');
Route::delete('/users_group/delete/{id}','Backend\UserGroups\UserGroupsController@destroy');
Route::get('/users_group/getusergroupbyid/{id}','Backend\UserGroups\UserGroupsController@getUserByID');
Route::put('/users_group/update/{id}','Backend\UserGroups\UserGroupsController@update');

//=====User API
Route::get('/users/list','Backend\Users\UsersController@index');
Route::get('/users/checkIfExisted/{field}/{value}','Backend\Users\UsersController@ValidateData');
Route::post('/users/save','Backend\Users\UsersController@store');
Route::delete('/users/delete/{id}','Backend\Users\UsersController@destroy');
Route::get('/users/getuserbyid/{id}','Backend\Users\UsersController@getUserByID');
Route::put('/users/update/{id}','Backend\Users\UsersController@update');