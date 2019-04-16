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

Route::get('/', 'ProductController@mainShop');
Route::get('/{id}', 'ProductController@singleShop');
// Route::get('/', function(){
// 	dd(Cart::content());
// 	//Cart::add('293ad', 'Product 1', 1, 9.99, ['size' => 'large']);
// });


//Admin
// Route::get('/admin', function () {
//     return redirect('admin/login');
// });
// Route::prefix('admin')->group(function(){
// 	Auth::routes();

// 	Route::get('/tool',function(){
// 		echo 1 ;
// 	});


// 	Route::middleware('auth')->group(function(){
// 		Route::get('/dashboard',function(){
// 			return view ('admin.dashboard.index');
// 		});
// 		Route::resource('/user','UserController');	
// 		Route::resource('/brand','BrandController');
// 		Route::resource('/category','CategoryController');
// 		Route::resource('/size','SizeController');
// 		Route::resource('/color','ColorController');

// 		Route::get('/product/detail/{id}', 'ProductController@detail');
// 		Route::get('/product/images/{id}', 'ProductController@images');
// 		Route::post('/product-image','ProductController@uploadImages');	

// 		Route::resource('/product','ProductController');
// 		Route::resource('/product_detail','ProductDetailController');
		
// 	});

// });		


Route::get('/home', 'HomeController@index')->name('home');
