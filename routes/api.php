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
Route::get('/account/logout','FrontEnd\Account\LoginController@AuthLogout');
Route::get('/customer/get','FrontEnd\Account\LoginController@getPasswordCustomer');

//BackEnd

//=====Commons=======================
Route::get('/getStore','Backend\commons\CommonsController@getStore');
Route::get('/getLanguage','Backend\commons\CommonsController@getLanguage');
Route::get('/getCreditType','Backend\commons\CommonsController@getCreditType');
Route::get('/getGeoZone','Backend\commons\CommonsController@getGeoZone');
Route::get('/getTaxClass','Backend\commons\CommonsController@getTaxClass');
Route::get('/getTaxRate','Backend\commons\CommonsController@getTaxRate');
Route::get('/getCustomerGroup','Backend\commons\CommonsController@getCustomerGroup');
Route::get('/getAttributeGroup','Backend\commons\CommonsController@getAttributeGroup');

//=====Setting API=============================

Route::get('/settings/item/','Backend\Settings\SettingsController@item');//use to get all config item to put into dropdown list in setting edit form 
Route::Resource('/settings','Backend\Settings\SettingsController');


//=====User Group API


Route::get('/getUsers','Backend\UserGroups\UserGroupsController@getUsers');
Route::get('/permission','Backend\UserGroups\UserGroupsController@getPermission');
Route::get('/users_group/checkIfExisted/{field}/{value}','Backend\UserGroups\UserGroupsController@ValidateData');
Route::Resource('/user_groups','Backend\UserGroups\UserGroupsController');

//=====User API
Route::get('/users_group','Backend\Users\UsersController@UserGroup');
Route::get('/user/checkIfExisted/{field}/{value}','Backend\Users\UsersController@ValidateData');
Route::Resource('/users','Backend\Users\UsersController');
Route::Resource('/resellers','Backend\Users\ResellerController');
Route::Resource('/carriers','Backend\Users\CarriersController');

//======Language API
Route::Resource('/languages','Backend\Languages\LanguagesController');

//======Currency API
Route::Resource('/currencies','Backend\Currencies\CurrenciesController');

//======Stock Status API
Route::Resource('/stock_status','Backend\Stocks\StocksController');

//======Order Status API
Route::Resource('/order_status','Backend\OrderStatus\OrderStatusController');

//======Credit Type API
Route::Resource('/credit_type','Backend\CreditOptions\CreditTypesController');

//======Credit Type Value API
Route::Resource('/credit_type_value','Backend\CreditOptions\CreditTypeValuesController');

//======Tax API
Route::Resource('/tax_class','Backend\Taxs\TaxClass\TaxClassController');
Route::Resource('/tax_rule','Backend\Taxs\TaxRule\TaxRuleController');
Route::Resource('/tax_rate','Backend\Taxs\TaxRate\TaxRateController');
Route::Resource('/tax_rate_to_customer_group','Backend\Taxs\TaxRateToCustomerGroup\TaxRateToCustomerGroupController');

//======Weight API
Route::Resource('/weights','Backend\Weights\WeightsController');

//======Length API
Route::Resource('/lengths','Backend\Lengths\LengthsController');

//======Manufacturer API
Route::Resource('/manufacturers','Backend\Manufacturers\ManufacturersController');

//======Download API
Route::Resource('/downloads','Backend\Downloads\DownloadsController');

//======Preview API
Route::Resource('/previews','Backend\Previews\PreviewsController');

//======Product Attribute API
Route::Resource('/product_attribute','Backend\Products\Attributes\AttributeController');

//======Product Attribute Group API
Route::Resource('/product_attribute_group','Backend\Products\AttributeGroups\AttributeGroupController');

//======Attribute API
Route::Resource('/attribute','Backend\Attributes\AttributesController');
Route::Resource('/attribute_group','Backend\Products\AttributeGroups\AttributeGroupController');