<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

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

//  SHOP
Route::group(['prefix' => 'shop'], function() {
    Route::get('index', 'AppController@getIndex')->name('show_index');
    Route::get('contact', 'AppController@showContact')->name('show_contacts');
    Route::get('partners', 'AppController@getPartners')->name('show_partners');
    Route::get('schronisko', 'AppController@getSchronisko')->name('show_schronisko');
    Route::get('product', 'AppController@getProducts')->name('show_product');
    Route::get('products/{category}/{subcategory}','AppController@getProductByCategory')->name('show_products');
    Route::get('product/{id}','AppController@getShowProductInfo')->name('show_product_info');
    Route::post('side_menu_filtering','AppController@postSideMenuFiltering')->name('side_menu_filtering');
    Route::post('filteringPost','AppController@postFiltering')->name('post_filtering');
    Route::get('filtering','AppController@getFiltering')->name('get_filtering');
});

Route::group(['prefix' => 'manage', 'middleware' => 'auth','middleware' => 'auth.admin'], function() {
    Route::post('create', 'ProductsController@postCreateProduct')->name('create_product');
    Route::get('update/{id}', 'ProductsController@getUpdateProduct')->name('update_product_get');
    Route::post('update/{id}', 'ProductsController@postUpdateProduct')->name('update_product_post');
    Route::get('delete/{id}', 'ProductsController@getDeleteProduct')->name('delete_product');
    Route::get('newproduct', 'ProductsController@getNewProduct')->name('new_product');
    Route::get('category_subcategory', 'ProductsController@getNewCatSub')->name('new_category_subcategory');
    Route::post('new_category', 'ProductsController@postNewCategory')->name('create_category');
    Route::post('new_subcategory', 'ProductsController@postNewSubcategory')->name('create_subcategory');
    Route::get('list_products', 'ProductsController@getProducts')->name('list_products');
    Route::get('list_orders', 'ProductsController@getOrders')->name('list_orders');
    Route::get('completeOrder/{id}', 'ProductsController@completeOrder')->name('completeOrder');
});

//  USER
Route::group(['prefix' => 'cart', 'middleware' => 'auth'], function() {
    Route::get('show_cart', 'ShoppingCartController@showCart')->name('show_cart');
    Route::post('/add','ShoppingCartController@addToCart');
    Route::post('/remove/{productId}/{amount}','ShoppingCartController@removeFromCart');
    Route::post('/update','ShoppingCartController@updateCart');
    Route::get('order', 'ShoppingCartController@getOrderInfo')->name('show_order_info');
    Route::post('order', 'ShoppingCartController@postOrder')->name('order_products');
});

Route::group(['prefix' => 'user'], function() {
    Route::get('orders', 'LoggedUsersController@showOrders')->name('show_orders');
    Route::get('profile', 'LoggedUsersController@showProfile')->name('show_profile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource("/users", 'UsersController', ["except"=>["show","create","store"]]);
});
