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
Route::get('/', function () {
    return view('shop.index');
})->name('shop.index');
Route::get('/contact', function () {
    return view('shop.contact');
})->name('shop.contact');
Route::get('/partners', 'AppController@getProducents')->name('shop.partners');
Route::get('/schronisko', function () {
    return view('shop.schronisko');
})->name('shop.schronisko');
Route::get('/products', function () {
    return view('shop.show_product');
})->name('shop.show_product');
//-------------------------------------------
Route::get('product', 'ProductsController@getProducts')->name('shop.show_products');
Route::get('product/{category}/{subcategory}','ProductsController@getProductByCategory')->name('shop.show_products_cat_sub');
    //'App\Http\Controllers\ProductsController@getProductByCategory')->name('shop.show_products');

//  ADMIN
Route::get('/admin/edit_product', function () {
    return view('admin.edit_product');
})->name('admin.edit_product');

//Route::get('/admin/edit_user', function () {
//    return view('admin.edit_user');
//})->name('admin.edit_user');

Route::get('/admin/category', function () {
    return view('admin.new_category_subcategory');
})->name('admin.new_category_subcategory');

Route::get('/admin/new_product', function () {
    return view('admin.new_product');
})->name('admin.new_product');

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
    Route::post('create', 'ProductsController@postCreateProduct')->name('manage.create');
    Route::get('update/{id}', 'ProductsController@getUpdateProduct')->name('manage.update');
    Route::post('update/{id}', 'ProductsController@postUpdateProduct')->name('manage.update');
    Route::get('delete/{id}', 'ProductsController@getDeleteProduct')->name('manage.delete');
});

//  LOGIN
Route::get('/login/login', function () {
    return view('login.login_form');
})->name('login.login_form');
Route::get('/login/signup', function () {
    return view('login.signup_form');
})->name('login.signup_form');
Route::get('/login/success', function () {
    return view('login.register_success');
})->name('login.register_success');

//  USER
Route::get('/login/profile', function () {
    return view('user.user_profile');
})->name('user.user_profile');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::resource("/users", UsersController::class, ["except"=>["show","create","store"]]);
});
