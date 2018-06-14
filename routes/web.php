<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// link reference multiple authentication https://www.codementor.io/okoroaforchukwuemeka/9-tips-to-set-up-multiple-authentication-in-laravel-ak3gtwjvt
// language

//Auth::routes();
// if (Request::is('customer*')){
    // Route::get('customer', 'FrontEnd\Account\AccountController@customer');
if (Request::is('account*')){
    // Route::middleware(['auth:account'])->prefix('account')->group(function () {
        Route::get('account', 'FrontEnd\Account\AccountController@customer');
        Route::get('account/{id}', 'FrontEnd\Account\AccountController@customer');
        // Route::get('/login','Auth\CustomerLoginController@showLoginForm')->name('auth.login');
        // Route::post('/login', 'Auth\CustomerLoginController@login')->name('auth.login.submit');
        // Route::get('logout/', 'Auth\CustomerLoginController@logout')->name('auth.logout');
        // Route::get('/', 'AdminController@index')->name('auth.dashboard');
    // });
};

Route::get('login',array('as'=>'login',function(){
    // return view('auth.customer_login');
    return view('frontend.index');
}));

Route::get('logout', function()
{
    Auth::guard('account')->logout();
    return redirect("login");
})->name('login');

// Route::post('login', function(Illuminate\Http\Request $request) 
// {
//     // if (Auth::guard(['email' => $request->get('email'), 'password' => $request->get('password')])) {
//     //     return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
//     // }
//     if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
//         return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
//         // return redirect()->intended(route('customer.dashboard'));
//       } 

//       return redirect()->back()->withInput($request->only('email', 'remember'));
//     // return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
// });

// Route::get('/login','Auth\CustomerLoginController@showLoginForm')->name('auth.login');
// Route::post('/login', 'Auth\CustomerLoginController@login')->name('auth.login.submit');
// Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\CustomerLoginController@login']);


if(isset($_COOKIE['Language'])){
    session(['languageActive' => $_COOKIE['Language']]);
} else {
    session(['languageActive' => 'English']);
    setcookie("Language", 'English', time()+3600*24*365, '/');
}
// Route::post('login', function(Illuminate\Http\Request $request) 
// {
//     if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
//         return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
//     }
//     return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
// });

Route::post('login', function(Illuminate\Http\Request $request)
{
    if($request->is_account==1){
        if (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // return redirect("account/dashboard");
            return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
        } 
    }else{
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
        }
    }
    return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
});

// Route::post('account/login', function(Illuminate\Http\Request $request) 
// {
//     if (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
//         return redirect("account/dashboard"); 
//     } 
    
//     return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
// });


Route::get('api/account/check_authorize','FrontEnd\Account\LoginController@checkAccountAuthorize');

if (Request::is('admin*')){
    
    Route::middleware(['auth'])->prefix('admin')->group(function () {

        if (Request::is('admin/api*')){
            Route::prefix('api')->group(function () {
                //=====Categories API=============================
                // Route::get('/categories/list','FrontEnd\Common\HeaderController@index');
                Route::resource('categories', 'Backend\Category\CategoryController');
                Route::get('getCategories', 'Backend\Category\CategoryController@getCategoriesList');
                Route::get('getCategories_type', 'Backend\Category\CategoryController@getCategoriesType');
                Route::get('getCategories_parent', 'Backend\Category\CategoryController@getCategoriesParent');
                Route::get('getLanguages', 'Backend\Languages\LanguagesController@getLanguage');
                //=====Product API=============================
                Route::resource('products', 'Backend\Products\ProductsController');
                Route::get('/getManufacturers','Backend\Manufacturers\ManufacturersController@getManufacturers');
                //=====Sale order=============================
                Route::resource('sale_order', 'Backend\Order\SaleOrderController');
                // Route::get('/getProductSelect','Backend\Products\ProductsController@getProductSelect');
                Route::get('/getTaxClass','Backend\commons\CommonsController@getTaxClass');
                Route::get('/getStore','Backend\commons\CommonsController@getStore');
                Route::get('/getStockStatus','Backend\commons\CommonsController@getStockStatus');
                Route::get('/getProductRelates','Backend\commons\CommonsController@getProductRelates');
                Route::get('/getFilter','Backend\commons\CommonsController@getFilter');
                Route::get('/getMenus', 'Backend\Settings\GroupRolesController@getMenus');
                //=====Carriers========================
                Route::get('getCarriers', 'Backend\Carriers\CarriersController@getCarriers');
                //=====User Role============================= 
                Route::resource('/user_role', 'Backend\Settings\GroupRolesController');
                //=====User=============================
                Route::resource('user_roles', 'Backend\UserRoles\UserRolesController');
                //=====Customer=============================
                Route::resource('customer_field', 'Backend\Customers\CustomerFieldController');

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
                Route::get('/getCarrier/','Backend\commons\CommonsController@getCarrier');
                //=====Setting API=============================

                Route::get('/settings/item/','Backend\Settings\SettingsController@item');//use to get all config item to put into dropdown list in setting edit form 
                Route::Resource('/settings','Backend\Settings\SettingsController');


                //=====User Group API


                Route::get('/getUsers','Backend\UserGroups\UserGroupsController@getUsers');
                Route::get('/permission','Backend\UserGroups\UserGroupsController@getPermission');
                Route::get('/users_group/checkIfExisted/{field}/{value}','Backend\UserGroups\UserGroupsController@ValidateData');


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
            });

        }else{
            Route::get('/{any?}',function(){
                return view('index');
            })->where(['any'=>'.*']);
        }
        
    });
    Route::get('auth/logout', function()
    {
        Auth::logout();
        return redirect("auth/login");
        // return response()->json(['success' => true, 'message' => 'You logout with success'], 200);
    })->name('login');
}else if (Request::is('auth*')){
    Route::post('auth/login', 'Auth\LoginController@login');
    Route::get('auth/login', 'Auth\LoginController@showLoginForm');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    Route::get('auth/logout', function()
    {
        Auth::logout();
        return redirect("auth/login");
        // return response()->json(['success' => true, 'message' => 'You logout with success'], 200);
    })->name('login');
    // dd(Request::path());
}else if (Request::is('api*')){
    Route::middleware([])->prefix('api')->group(function () {

        Route::get('product_cart', 'FrontEnd\Product\CartController@ProductCart');
        Route::get('getLocations/{country_id?}', 'Backend\commons\CommonsController@getLocations');
        Route::get('getShipping/{id?}', 'Backend\commons\CommonsController@getShipping');
        Route::get('get_product/{num}', 'FrontEnd\Product\ProductController@GetProduct');
        Route::get('footer', 'FrontEnd\Common\FooterController@getFooter');

        //Information
        Route::get('information/{id}', 'FrontEnd\Information\InformationController@index');
        // Account
        //Route::post('account/register', 'FrontEnd\Account\RegisterController@save');
    });
}else if (Request::is('lang*')){
    Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'FrontEnd\Language\LanguageController@switchLang']);
}else{
    Route::get('/{any?}','FrontEnd\Product\FrontEndController@index')->where(['any'=>'.*']);
}

// Backend
//=====Shipment=============================


// Front End
Route::post('/AddToCart','FrontEnd\Product\CartController@AddToCart');
Route::post('/RemoveFromCart','FrontEnd\Product\CartController@RemoveFromCart');
Route::post('/UpdateCart','FrontEnd\Product\CartController@UpdateCart');
Route::post('/checkout','FrontEnd\Product\CartController@Checkout');
// Front End Router
Route::resource('/', 'FrontEnd\Product\CartController');
Route::get('my_account', 'FrontEnd\Product\CartController@index');
Route::get('signin', 'FrontEnd\Product\CartController@index');

// Account Customer
Route::get('/api/address', 'FrontEnd\Account\AddressController@index');
Route::get('/api/get_checkout_address', 'FrontEnd\Account\AddressController@getCheckoutAddress');
Route::get('/api/customer_info', 'FrontEnd\Account\AccountController@getCustomer');
Route::get('/api/wishlist', 'FrontEnd\Account\WishlistController@index');
Route::resource('/api/order', 'FrontEnd\Account\OrderController');

// Front End API
Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');
// =====Store
Route::get('/api/store/getStoreData', 'FrontEnd\Store\StoreController@index');
/*|Api Request Header--*/
Route::get('/api/header','FrontEnd\Common\HeaderController@index');
/*--| Api Request Slide--*/
Route::get('/api/slide','FrontEnd\Includes\SlideController@index');
/*--| Api Request Product--*/
Route::resource('/api/category','FrontEnd\Product\CategoryController');
Route::get('/api/latest','FrontEnd\Product\LastestController@index');
Route::get('/api/bestSeller','FrontEnd\Product\BestSellerController@index');
Route::get('/api/recommandProduct','FrontEnd\Product\RecommandController@index');
// Route::get('/api/product_detail','FrontEnd\Product\ProductController@index');

/*--| Api Request Banner--*/
Route::get('/api/banner','FrontEnd\Design\BannerController@index');

Route::resource('test/', 'FrontEnd\TestController');
Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');

// authentication 

// Route::post('login', function(Illuminate\Http\Request $request) 
// {
//     if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
//         return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
//     }
//     if (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
//     // return response()->json(['success' => true, 'message' => 'Login account successfully performed'], 200);
//     return redirect("account/dashboard"); 
//     } 
//     return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
// });

Route::group(['middleware' => 'auth'], function() {
    Route::get('users', function() {
        $users = App\User::all();
    });

    // admin router
    Route::get('/admin', 'Backend\CommonController@list');
    Route::get('/admin/list', 'Backend\CommonController@list');
});

// Route::group(['middleware' => 'account'], function() {
//     Route::get('/account', 'Backend\CommonController@list');
// });


