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

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Samsung_phone;
use App\Phone;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Location;
use function foo\func;

/*
 * ADMIN_PANEL_HOME_
 */
Route::get('/home/category_list',function (){
    $category_list=Category::all();
    return view('categoru_list',compact('category_list'));
});

Route::get('/home/product_list',function (){
    $phone_list=Phone::all();
    return view('product_list',compact('phone_list'));
});

Route::get('/home/user_list',function (){
    $users=User::all();
    return view('users_list',compact('users'));
});
Route::get('/home/order_list','OrderListController@index');

Route::get('/home/product_list_add',function (){
    return view('product_list_add');
});
Route::get('/home', 'HomeController@index')->name('home');


/*
 * ADMIN_PANEL_ACTIONS_ROUTE_
 */

Route::post('/delOrder','Product_controller@DeleteProductFromOrder');
Route::post('/product_list_add','PhoneController@AddProduct');
Route::post('/category_list_add','CategoryController@Category_add');
Route::post('/category_list_update','CategoryController@update');
Route::post('/category_list_delete','CategoryController@delete');
Route::post('/product_list_delete','PhoneController@delete_product');
//Route::get('/phones/{phone_id}','Product_controller@index');


/*
 * MAIN_PAGES_
 */

Route::get('/phones/{phone_category}/phone/{phone_id}','Product_controller@index');

Route::get('/phones/{phone_category}','CategoryController@index');

Route::post('/phones/{phone_category}/phone/{phone_id}/AddOrder','Product_controller@AddProdToOrder');

Route::post('/phones/{phone_id}/succes_send','Comment_send@index');

Route::post('/order_confirm','OrdersController@Order_Confirm');

Route::get('/', function () {
    $phones = Phone::all();
    return view('Main',compact('phones'));
});


/*
 * USER_PANEL_ACTIONS_
 */

Route::get('/user_home',function (){
    return view('user_home');
});

Route::get('/user_home/user_profile',function (){
    return view('user_profile');
});

/*
 * OTHER_
 */

Route::resource('category','CategoryController');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();
