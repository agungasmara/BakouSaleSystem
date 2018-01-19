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
Route::get('/customer/test','FrontEnd\Account\LoginController@test');
Route::post('/customer/login','FrontEnd\Account\LoginController@AuthLogin');
Route::get('/customer/get','FrontEnd\Account\LoginController@getPasswordCustomer');

//BackEnd

//=====Setting API=============================
Route::get('/getStore','Backend\Settings\SettingsController@getStore');
Route::get('/settings/item/','Backend\Settings\SettingsController@item');//use to get all config item to put into dropdown list in setting edit form 
Route::Resource('/settings','Backend\Settings\SettingsController');


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
Route::get('/users_group','Backend\Users\UsersController@UserGroup');
Route::get('/user/checkIfExisted/{field}/{value}','Backend\Users\UsersController@ValidateData');
Route::Resource('/users','Backend\Users\UsersController');
// Route::get('/userslist','Backend\Users\UsersController@list');
// Route::post('/user/save','Backend\Users\UsersController@store');
// Route::delete('/user/delete/{id}','Backend\Users\UsersController@destroy');
// Route::get('/user/getuserbyid/{id}','Backend\Users\UsersController@getUserByID');
// Route::put('/user/update/{id}','Backend\Users\UsersController@update');
