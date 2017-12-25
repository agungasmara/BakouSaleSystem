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

// Front End Design
// Route::resource('/', 'FrontEnd\TestController');
// Route::get('/', function () {
//     return view('frontend.index');
// });

// Front End Router
Route::resource('/', 'FrontEnd\Product\CartController');
Route::get('my_account', 'FrontEnd\Product\CartController@index');
Route::get('signin', 'FrontEnd\Product\CartController@index');

// Front End API
Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');
/*|Api Request Header--*/
Route::get('/api/header','FrontEnd\common\HeaderController@index');
/*--| Api Request Slide--*/
Route::get('/api/slide','FrontEnd\includes\SlideController@index');
Route::get('/api/lastest','FrontEnd\Product\LastestController@index');


// Route::resource('product/category', 'FrontEnd\Product\FrontEndController');
// Route::get('product/detail', 'FrontEnd\Product\FrontEndController@product_detail');
// Route::get('ajax/product', 'FrontEnd\Product\FrontEndController@ajax_product');
// Route::get('order/status', 'FrontEnd\Product\FrontEndController@order_status');
// Route::get('order/lists', 'FrontEnd\Product\FrontEndController@order_lists');
// Route::get('whish/lists', 'FrontEnd\Product\FrontEndController@wish_lists');
// Route::get('cart', 'FrontEnd\Product\FrontEndController@cart_view');
// Route::get('customer/address', 'FrontEnd\Product\FrontEndController@customer_address');
// Route::get('account', 'FrontEnd\Product\FrontEndController@account');


Route::resource('test/', 'FrontEnd\TestController');
Route::get('/api/getTest', 'FrontEnd\TestController@getTest');
Route::get('/api/show/{id}', 'FrontEnd\TestController@getShow');
Route::put('/api/update', 'FrontEnd\TestController@UpdateApi');

// authentication 

Route::post('login', function(Illuminate\Http\Request $request) 
{
    if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
        return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
    }
    return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
});


Route::post('api/register', function(Illuminate\Http\Request $request) 
{
    // if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
    //     return response()->json(['success' => true, 'message' => 'Login successfully performed'], 200);
    // }

    // return response()->json(['success' => false, 'message' => 'Unable to login'], 401);
});

Route::group(['middleware' => 'auth'], function() {
    
    Route::get('users', function() {
        $users = App\User::all();

        return response()->json(['success' => 'true', 'message' => 'Loading users', 'data' => ['users' => $users->toJson()]], 200);
    });

    // admin router
    Route::get('/admin', 'Backend\CommonController@list');
    Route::get('/admin/list', 'Backend\CommonController@list');
});


// authentication

Route::post('auth/login', 'Auth\LoginController@login');

Route::get('auth/login', 'Auth\LoginController@showLoginForm');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('logout', function()
{
    Auth::logout();
    return redirect("auth/login");
    // return response()->json(['success' => true, 'message' => 'You logout with success'], 200);
})->name('login');