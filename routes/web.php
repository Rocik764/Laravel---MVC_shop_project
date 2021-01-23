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
    Route::get('partners', 'AppController@getProducents')->name('show_partners');
    Route::get('product', 'AppController@getProducts')->name('show_product');
    Route::get('products/{category}/{subcategory}','AppController@getProductByCategory')->name('show_products');
    Route::get('product/{id}','AppController@getShowProductInfo')->name('show_product_info');
    Route::match(array('GET', 'POST'),'side_menu_filtering','AppController@postSideMenuFiltering')->name('side_menu_filtering');
    Route::match(array('GET', 'POST'),'filteringPost','AppController@postFiltering')->name('post_filtering');
    Route::get('filtering','AppController@getFiltering')->name('get_filtering');
});

Route::group(['prefix' => 'manage', 'middleware' => 'auth','middleware' => 'auth.admin'], function() {
    Route::post('create', 'ProductsController@postCreateProduct')->name('create_product');
    Route::get('update/{id}', 'ProductsController@getUpdateProduct')->name('update_product_get');
    Route::post('update/{id}', 'ProductsController@postUpdateProduct')->name('update_product_post');
    Route::get('delete/{id}', 'ProductsController@getDeleteProduct')->name('delete_product');
    Route::get('new_product', 'ProductsController@getNewProduct')->name('new_product');
    Route::post('new_producent', 'ProductsController@postNewProducent')->name('create_producent');
    Route::get('category_subcategory', 'ProductsController@getNewCatSub')->name('new_category_subcategory');
    Route::get('edit_category_subcategory', 'ProductsController@getEditCatSub')->name('edit_category_subcategory');
    Route::post('new_category', 'ProductsController@postNewCategory')->name('create_category');
    Route::post('new_subcategory', 'ProductsController@postNewSubcategory')->name('create_subcategory');
    Route::get('list_products', 'ProductsController@getProducts')->name('list_products');
    Route::get('list_orders', 'ProductsController@getOrders')->name('list_orders');
    Route::get('completeOrder/{id}', 'ProductsController@completeOrder')->name('completeOrder');
    Route::post('show_details/{uId}/{date}', 'ProductsController@getDetails')->name('getDetails');
    Route::get('delete_category/{id}', 'ProductsController@postDeleteCategory')->name('deleteCategory');
    Route::get('delete_subcategory/{id}', 'ProductsController@postDeleteSubcategory')->name('deleteSubcategory');
    Route::get('delete_producent/{id}', 'ProductsController@postDeleteProducent')->name('deleteProducent');
});

//  USER
Route::group(['prefix' => 'cart', 'middleware' => 'auth'], function() {
    Route::get('show_cart', 'ShoppingCartController@showCart')->name('show_cart');
    Route::post('/add','ShoppingCartController@addToCart')->name('cart_add');
    Route::post('/remove/{productId}/{amount}','ShoppingCartController@removeFromCart')->name('cart_remove');
    Route::post('/update','ShoppingCartController@updateCart')->name('cart_update');
    Route::get('order', 'ShoppingCartController@getOrderInfo')->name('show_order_info');
    Route::post('order', 'ShoppingCartController@postOrder')->name('order_products');
});

Route::group(['prefix' => 'user'], function() {
    Route::get('orders', 'LoggedUsersController@showOrders')->name('show_orders');
    Route::get('profile', 'LoggedUsersController@showProfile')->name('show_profile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\AppController::class, 'getHome'])->name('index');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource("/users", 'UsersController', ["except"=>["show","create","store"]]);
});
