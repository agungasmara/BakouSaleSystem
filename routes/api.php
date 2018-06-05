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

// autentication & Security for mobile user
Route::group(['middleware' => ['auth:api','SettingConfig']], function(){
	Route::get('v1/address', 'FrontEnd\Account\MobileAPI\AddressController@index');

});

Route::post('account/login', 'FrontEnd\Account\LoginController@login');
Route::post('account/register', 'FrontEnd\Account\RegisterController@register');


Route::group(['middleware' => ['SettingConfig']], function(){
    //FrontEnd
    //=====Customer Register API
    // Route::post('/customer/register','FrontEnd\Account\RegisterController@store');
    Route::get('/customer/test','FrontEnd\Account\LoginController@test');
    Route::post('/customer/login','FrontEnd\Account\LoginController@AuthLogin');
    Route::get('/account/logout','FrontEnd\Account\LoginController@AuthLogout');
    Route::get('/customer/get','FrontEnd\Account\LoginController@getPasswordCustomer');
    // =====Product
    Route::get('/product_detail/{product_id}/{category_id}','FrontEnd\Product\ProductController@index');
    Route::post('/product_review','FrontEnd\Product\ProductController@product_review');
    Route::Resource('/user_groups','Backend\UserGroups\UserGroupsController');
});
