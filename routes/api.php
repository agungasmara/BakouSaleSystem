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
Route::get('/settings/list','Backend\Settings\SettingsController@index');
Route::post('/settings/save','Backend\Settings\SettingsController@store');
Route::get('/settings/edit/{id}','Backend\Settings\SettingsController@edit');
Route::get('/settings/item/','Backend\Settings\SettingsController@item');//use to get all config item to put into dropdown list in setting edit form
Route::delete('/settings/delete/{id}','Backend\Settings\SettingsController@destroy');
Route::put('/settings/update/{id}','Backend\Settings\SettingsController@update');

//=====User Group API

Route::get('/getUsers','Backend\UserGroups\UserGroupsController@getUsers');
Route::get('/permission','Backend\UserGroups\UserGroupsController@getPermission');
Route::get('/users_group/checkIfExisted/{field}/{value}','Backend\UserGroups\UserGroupsController@ValidateData');
Route::post('/users_group/save','Backend\UserGroups\UserGroupsController@store');
Route::get('/users_group/list','Backend\UserGroups\UserGroupsController@index');
Route::delete('/users_group/delete/{id}','Backend\UserGroups\UserGroupsController@destroy');
Route::get('/users_group/edit/{id}','Backend\UserGroups\UserGroupsController@edit');
Route::put('/users_group/update/{id}','Backend\UserGroups\UserGroupsController@update');

//=====User API
Route::get('/users/list','Backend\Users\UsersController@index');
Route::get('/user/checkIfExisted/{field}/{value}','Backend\Users\UsersController@ValidateData');
Route::post('/users/save','Backend\Users\UsersController@store');
Route::delete('/users/delete/{id}','Backend\Users\UsersController@destroy');
Route::get('/users/edit/{id}','Backend\Users\UsersController@edit');
Route::put('/users/update/{id}','Backend\Users\UsersController@update');

//=====Language API
Route::get('/languages/list','BackEnd\Languages\LanguagesController@index');
Route::post('/languages/save','Backend\Languages\LanguagesController@store');
Route::get('/languages/edit/{id}','Backend\Languages\LanguagesController@edit');
Route::put('/languages/update/{id}','Backend\Languages\LanguagesController@update');
Route::delete('/languages/delete/{id}','Backend\Languages\LanguagesController@destroy');




Route::get('setting/test','Backend\Settings\SettingsController@test');