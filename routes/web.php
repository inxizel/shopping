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


//Admin
Route::get('/admin', function () {
    return redirect('admin/login');
});
Route::prefix('admin')->group(function(){
	Auth::routes();

	Route::get('/tool',function(){
		echo 1 ;
	});


	Route::middleware('auth')->group(function(){
		Route::get('/dashboard',function(){
			return view ('admin.dashboard.index');
		});
		Route::resource('/user','UserController');	
		Route::resource('/product','ProductController');
		Route::resource('/brand','BrandController');
		Route::resource('/category','CategoryController');

		Route::get('/product-image', function ()
		{
			return view('admin.product.uploadImages');
		});	
		Route::post('/product-image','ProductController@uploadImages');	
	});

});		
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
