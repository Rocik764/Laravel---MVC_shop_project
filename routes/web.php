<?php

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
});

//Route::get('/admin/edit_user', function () {
//    return view('admin.edit_user');
//})->name('admin.edit_user');

//Route::get('/admin/new_user', function () {
//    return view('admin.new_user');
//})->name('admin.new_user');

//Route::group(['prefix' => 'user'], function() {
//    Route::get('users_list', 'App\Http\Controllers\UsersControllerOld@getUsers')->name('user.users_list');
//    Route::post('create', 'App\Http\Controllers\UsersControllerOld@postCreateUser')->name('user.create');
//    Route::get('update/{id}', 'App\Http\Controllers\UsersControllerOld@getUpdateUser')->name('user.update');
//    Route::post('update/{id}', 'App\Http\Controllers\UsersControllerOld@postUpdateUser')->name('user.update');
//    Route::get('delete/{id}', 'App\Http\Controllers\UsersControllerOld@getDeleteUser')->name('user.delete');
//});

Route::group(['prefix' => 'manage'], function() {
    Route::post('create', 'ProductsController@postCreateProduct')->name('create_product');
    Route::get('update/{id}', 'ProductsController@getUpdateProduct')->name('update_product_get');
    Route::post('update/{id}', 'ProductsController@postUpdateProduct')->name('update_product_post');
    Route::get('delete/{id}', 'ProductsController@getDeleteProduct')->name('delete_product');
    Route::get('newproduct', 'ProductsController@getNewProduct')->name('new_product');
    Route::get('category_subcategory', 'ProductsController@getNewCatSub')->name('new_category_subcategory');
    Route::post('new_category', 'ProductsController@postNewCategory')->name('create_category');
    Route::post('new_subcategory', 'ProductsController@postNewSubcategory')->name('create_subcategory');
});

//  USER
Route::group(['prefix' => 'cart'], function() {
    Route::get('show_cart', 'ShoppingCartController@showCart')->name('show_cart');
    Route::post('/add','ShoppingCartController@addToCart');
});

Route::get('/login/profile', function () {
    return view('user.user_profile');
})->name('user.user_profile');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource("/users", UsersController::class, ["except"=>["show","create","store"]]);
});
