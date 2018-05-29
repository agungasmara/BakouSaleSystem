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
});
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
Route::get('/getAttribute','Backend\commons\CommonsController@getAttribute');
Route::get('/getFilterGroup','Backend\commons\CommonsController@getFilterGroup');
Route::get('/getLayout','Backend\commons\CommonsController@getLayout');
Route::get('/getOptions','Backend\commons\CommonsController@getOptions');
Route::get('/getChildOption/{id}','Backend\commons\CommonsController@getChildOption');
Route::get('/getSelectList/{cid}','Backend\commons\CommonsController@getSelectList');
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
Route::Resource('/carriers','Backend\carriers\CarriersController');

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
Route::Resource('/attribute_group','Backend\Attributes\AttributeGroupController');

//======Filter API
Route::Resource('/filters','Backend\Filter\FiltersController');
Route::Resource('/filters_group','Backend\Filter\FilterGroupController');

//======CategoryType API
Route::Resource('/category_type','Backend\CategoryType\CategoryTypeController');


//======Information API
Route::Resource('/informations','Backend\Informations\InformationsController');

//======Option API
Route::Resource('/options','Backend\Options\OptionsController');
Route::get('/options/{id}/{lid}/edit','Backend\Options\OptionsController@edit');
Route::put('/options/{id}/{lid}','Backend\Options\OptionsController@update');

//======Option API
Route::Resource('/banners','Backend\Customers\BannersController');

//======Customer Group API
Route::Resource('/customer_groups','Backend\Customers\CustomerGroupsController');

//======Customer API
Route::Resource('/customers','Backend\Customers\CustomersController');
Route::post('/filterCustomer','Backend\Customers\CustomersController@filterCustomer');

//=====Sale order=============================
Route::resource('sale_order', 'Backend\Order\SaleOrderController');

//=====carrier=============================
// Route::resource('carrier', 'Backend\Shipment\ShipmentController');
Route::resource('/getShipment','Backend\Shipment\ShipmentController');
Route::post('/filterShippment','Backend\Shipment\ShipmentController@filterShippment');
Route::get('/undelivery','Backend\Shipment\ShipmentController@undelivery');
Route::get('/delivery','Backend\Shipment\ShipmentController@delivery');
Route::get('/pickup','Backend\Shipment\ShipmentController@pickups');