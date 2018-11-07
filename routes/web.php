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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
  //auth
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

  //password reset routes
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

  //categories
  Route::get('/categories', 'CategoryController@index')->name('admin.categories');
  Route::get('/add-category', 'CategoryController@add_category')->name('admin.add-category');
  Route::post('/preview-category-img', 'CategoryController@preview_category_img')->name('admin.preview-category-img');
  Route::post('/remove-category-img', 'CategoryController@remove_img')->name('admin.remove-category-img');
  Route::post('/create-category', 'CategoryController@create_category')->name('admin.create-category');
  Route::get('/get-parent-categories', 'CategoryController@get_parent_categories')->name('admin.get-parent-categories');
  Route::post('/get-categories-table', 'CategoryController@get_categories_table')->name('admin.get-categories-table');
  Route::get('/edit-category/{url}', 'CategoryController@edit_category')->name('admin.edit-category');
});
