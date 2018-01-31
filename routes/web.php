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

// language

if(isset($_COOKIE['Language'])){
    session(['languageActive' => $_COOKIE['Language']]);
} else {
    session(['languageActive' => 'English']);
    setcookie("Language", 'English', time()+3600*24*365, '/');
}
Route::post('login', function(Illuminate\Http\Request $request) 
{
    if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
        return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
    }

    return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
});

Route::post('account/login', function(Illuminate\Http\Request $request) 
{
    if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
        return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
    }
    return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
});


Route::get('api/account/check_authorize','FrontEnd\Account\LoginController@checkAccountAuthorize');

if (Request::is('admin*')){
    
    Route::middleware(['auth'])->prefix('admin')->group(function () {

        if (Request::is('admin/api*')){
            Route::prefix('api')->group(function () {
                //=====Categories API=============================
                // Route::get('/categories/list','FrontEnd\Common\HeaderController@index');
                Route::resource('categories', 'Backend\Category\CategoryController');
                

                 //=====Product API=============================
                Route::resource('products', 'Backend\Products\ProductsController');
                

                Route::get('/getMenus', 'Backend\Settings\GroupRolesController@index');
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
}else if(Request::is('account_auth*')){
    Route::post('auth/login', 'Auth\LoginController@login');

    Route::get('auth/login', 'Auth\LoginController@showLoginForm');

    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    Route::get('auth/logout', function()
    {
        Auth::logout();
        return redirect("auth/login");
        // return response()->json(['success' => true, 'message' => 'You logout with success'], 200);
    })->name('login');
}else if (Request::is('api*')){
    Route::middleware([])->prefix('api')->group(function () {

        Route::get('product_cart', 'FrontEnd\Product\CartController@ProductCart');
        Route::get('get_product/{num}', 'FrontEnd\Product\ProductController@GetProduct');
        Route::get('footer', 'FrontEnd\Common\FooterController@getFooter');

        //Information
        Route::get('information/{id}', 'FrontEnd\Information\InformationController@index');
        // Account
        Route::post('account/register', 'FrontEnd\Account\RegisterController@save');
    });
}else if (Request::is('lang*')){
    Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'FrontEnd\Language\LanguageController@switchLang']);
}else{
    Route::get('/{any?}','FrontEnd\Product\FrontEndController@index')->where(['any'=>'.*']);
}

Route::post('/AddToCart','FrontEnd\Product\CartController@AddToCart');
Route::post('/RemoveFromCart','FrontEnd\Product\CartController@RemoveFromCart');
Route::post('/UpdateCart','FrontEnd\Product\CartController@UpdateCart');
Route::post('/checkout','FrontEnd\Product\CartController@Checkout');


// // Front End Design
// // Route::resource('/', 'FrontEnd\TestController');
// // Route::get('/', function () {
// //     return view('frontend.index');
// // });

// Front End Router
Route::resource('/', 'FrontEnd\Product\CartController');
Route::get('my_account', 'FrontEnd\Product\CartController@index');
Route::get('signin', 'FrontEnd\Product\CartController@index');
// Account Customer
Route::get('/api/address', 'FrontEnd\Account\AddressController@index');
Route::get('/api/wishlist', 'FrontEnd\Account\WishlistController@index');


// Front End API
Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');
/*|Api Request Header--*/
Route::get('/api/header','FrontEnd\Common\HeaderController@index');
/*--| Api Request Slide--*/
Route::get('/api/slide','FrontEnd\Includes\SlideController@index');
Route::get('/api/latest','FrontEnd\Product\LastestController@index');
Route::get('/api/bestSeller','FrontEnd\Product\BestSellerController@index');
Route::get('/api/detail/{id}','FrontEnd\Product\ProductController@index');

/*--| Api Request Banner--*/
Route::get('/api/banner','FrontEnd\Design\BannerController@index');
// Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
// Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
// Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');
// /*|Api Request Header--*/
// Route::get('/api/header','FrontEnd\common\HeaderController@index');
// /*--| Api Request Slide--*/
// Route::get('/api/slide','FrontEnd\includes\SlideController@index');

Route::resource('test/', 'FrontEnd\TestController');
Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');

// Route::resource('product/category', 'FrontEnd\Product\FrontEndController');
// Route::get('product/detail', 'FrontEnd\Product\FrontEndController@product_detail');
// Route::get('ajax/product', 'FrontEnd\Product\FrontEndController@ajax_product');
// Route::get('order/status', 'FrontEnd\Product\FrontEndController@order_status');
// Route::get('order/lists', 'FrontEnd\Product\FrontEndController@order_lists');
// Route::get('whish/lists', 'FrontEnd\Product\FrontEndController@wish_lists');
// Route::get('cart', 'FrontEnd\Product\FrontEndController@cart_view');
// Route::get('customer/address', 'FrontEnd\Product\FrontEndController@customer_address');
// Route::get('account', 'FrontEnd\Product\FrontEndController@account');


// Route::resource('test/', 'FrontEnd\TestController');
// Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
// Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
// Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');

// authentication 

Route::post('login', function(Illuminate\Http\Request $request) 
{
    if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
        return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
    }
    return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
});

Route::post('api/register1', function(Illuminate\Http\Request $request) 
{
    // if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
    //     return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
    // }

    // return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
});

Route::group(['middleware' => 'auth'], function() {
    
    Route::get('users', function() {
        $users = App\User::all();

    //         return response()->json(['success' => 'true', 'message' => 'Loading users', 'data' => ['users' => $users->toJson()]], 200);

//         return response()->json(['success' => 'true', 'message' => 'Loading users', 'data' => ['users' => $users->toJson()]], 200);
        
    });

    // admin router
    Route::get('/admin', 'Backend\CommonController@list');
    Route::get('/admin/list', 'Backend\CommonController@list');
});
//     Route::get('/admin', 'Backend\CommonController@list');
//     Route::get('/admin/list', 'Backend\CommonController@list');

//     Route::get('welcome/', function () {
//         return view('index');
//     });

//     Route::get('register/', function () {
//         return view('index');
//     });
//     Route::get('login/', function () {
//         return view('index');
//     });

//     Route::get('admin/list', function () {
//         return view('index');
//     });
//     Route::get('list', function () {
//         return view('index');
//     });
// });

// // authentication
// //Backend


