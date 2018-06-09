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

// Authentication routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

//Registration routes
Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);

Route::get('/contact', ['as' => 'contact.index', 'uses' => 'PagesController@getContact']);
Route::post('/contact', ['as' => 'contact.post', 'uses' => 'PagesController@postContact']);
Route::get('/about', ['as' => 'about.index', 'uses' => 'PagesController@getAbout']);
Route::get('/', ['as' => 'home.index', 'uses' => 'PagesController@getIndex']);

Route::get('/dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@dashboardIndex', 'middleware' => 'roles', 'roles' => 'Admin']);

Route::get('/dashboard/products', ['as' => 'dashboard.products.index', 'uses' => 'DashboardController@dashboardProductIndex', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::get('/dashboard/products/create', ['as' => 'dashboard.products.create', 'uses' => 'DashboardController@dashboardProductCreate', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::post('/dashboard/products', ['as' => 'dashboard.products.store', 'uses' => 'DashboardController@dashboardProductStore', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::get('/dashboard/products/{id}', ['as' => 'dashboard.products.show', 'uses' => 'DashboardController@dashboardProductShow', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::get('/dashboard/products/{id}/edit', ['as' => 'dashboard.products.edit', 'uses' => 'DashboardController@dashboardProductEdit', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::put('/dashboard/products/{id}', ['as' => 'dashboard.products.update', 'uses' => 'DashboardController@dashboardProductUpdate', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::delete('/dashboard/products/{id}', ['as' => 'dashboard.products.destroy', 'uses' => 'DashboardController@dashboardProductDestroy', 'middleware' => 'roles', 'roles' => 'Admin']);

Route::get('/dashboard/categories', ['as' => 'dashboard.categories.index', 'uses' => 'DashboardCategoryController@index', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::post('/dashboard/categories', ['as' => 'dashboard.categories.store', 'uses' => 'DashboardCategoryController@store', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::post('/dashboard/categories/store', ['as' => 'dashboard.subcategories.store', 'uses' => 'DashboardCategoryController@subCategoryStore', 'middleware' => 'roles', 'roles' => 'Admin']);

Route::get('/categories', ['as' => 'categories.index', 'uses' => 'CategoryController@index']);
Route::get('/categories/{slug}', ['as' => 'categories.show', 'uses' => 'CategoryController@show']);

Route::get('/categories/{slug}/{id}', ['as' => 'subcategories.show', 'uses' => 'CategoryController@SubCategoryShow']);

Route::get('/dashboard/users', ['as' => 'dashboard.users.index', 'uses' => 'DashboardUsersController@index', 'middleware' => 'roles', 'roles' => 'Admin']);
Route::post('/dashboard/users/assign', ['as' => 'dashboard.assign', 'uses' => 'DashboardUsersController@UserAssign', 'middleware' => 'roles', 'roles' => 'Admin']);

// Route::get('products/{slug}', ['as' => 'product.single', 'uses' => 'PagesController']);
Route::resource('products', 'ProductController', ['except' => 'show']);
Route::get('products/{slug}', ['as' => 'products.show', 'uses' => 'ProductController@show'])->where('slug', '[\w\d\-\_]+');

// Product sortBy
Route::get('products/sort', ['as' => 'products.sort', 'uses' => 'ProductController@sortBy']);

// Vue
Route::get('vue', ['as' => 'products.vue', 'uses' => 'ProductController@vue']);
Route::get('vue/api', ['as' => 'products.data', 'uses' => 'ProductController@getData']);

Route::resource('tags', 'TagController', ['except' => 'create']);

// Auth::routes();

// Route::get('/home', 'HomeController@index');

Route::post('comments/{product_id}', ['as' => 'comments.store', 'uses' => 'CommentsController@store']);
Route::get('comments/{id}/edit', ['as' => 'comments.edit', 'uses' => 'CommentsController@edit']);
Route::put('comments/{id}', ['as' => 'comments.update', 'uses' => 'CommentsController@update']);
Route::delete('comments/{id}', ['as' => 'comments.destroy', 'uses' => 'CommentsController@destroy']);
Route::get('comments/{id}/delete', ['as' => 'comments.delete', 'uses' => 'CommentsController@delete']);
