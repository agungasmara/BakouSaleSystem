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
//=====Customer Register API
Route::post('/customer/register','FrontEnd\Account\RegisterController@store');
Route::get('/customer/register/get','FrontEnd\Account\RegisterController@index');
Route::get('/customer/get','FrontEnd\Account\RegisterController@getMails');

//BackEnd

//=====Setting API=============================
Route::get('/getStore','Backend\Settings\SettingsController@getStore');
Route::get('/settings/list','Backend\Settings\SettingsController@index');
Route::post('/settings/save','Backend\Settings\SettingsController@store');
Route::delete('/settings/delete/{id}','Backend\Settings\SettingsController@destroy');
Route::get('/settings/getsettingbyid/{id}','Backend\Settings\SettingsController@getSettingByID');
Route::put('/settings/update/{id}','Backend\Settings\SettingsController@update');

//=====User Group API

Route::get('/getUsers','Backend\UserGroups\UserGroupsController@getUsers');
Route::get('/permission','Backend\UserGroups\UserGroupsController@getPermission');
Route::post('/users_group/save','Backend\UserGroups\UserGroupsController@store');
Route::get('/users_group/list','Backend\UserGroups\UserGroupsController@index');
Route::delete('/users_group/delete/{id}','Backend\UserGroups\UserGroupsController@destroy');
Route::get('/users_group/getusergroupbyid/{id}','Backend\UserGroups\UserGroupsController@getUserByID');
Route::put('/users_group/update/{id}','Backend\UserGroups\UserGroupsController@update');

//=====User API
Route::get('/users/list','Backend\Users\UsersController@index');
Route::get('/user/checkIfExisted/{field}/{value}','Backend\Users\UsersController@ValidateData');
Route::post('/users/save','Backend\Users\UsersController@store');
Route::delete('/users/delete/{id}','Backend\Users\UsersController@destroy');
Route::get('/users/getuserbyid/{id}','Backend\Users\UsersController@edit');
Route::put('/users/update/{id}','Backend\Users\UsersController@update');

//=====Language API
Route::get('/languages/list','BackEnd\Languages\LanguagesController@index');
Route::post('/languages/save','Backend\Languages\LanguagesController@store');
Route::put('/languages/update/{id}','Backend\Languages\LanguagesController@update');
Route::delete('/languages/delete/{id}','Backend\Languages\LanguagesController@destroy');