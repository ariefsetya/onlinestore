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


Auth::routes();

Route::get('/', 'GuestController@index')->name('home');

Route::get('/crud/products','CrudController@products')->name('crudproducts_home');

//guests
Route::get('/products','GuestController@products')->name('product_home');

Route::get('/detail/{id}','GuestController@products_detail')->name('product_detail');

Route::get('/cart','HomeController@cart')->name('cart');

Route::post('/addcart/{id}','HomeController@addcart')->name('addcart');
Route::get('/addcart/{id}',function($id){
	return redirect()->route('product_detail',[$id]);
});
Route::post('/changeqty/{id}','HomeController@changeqty')->name('changeqty');

Route::get('/checkout','HomeController@checkout')->name('checkout');
Route::post('/checkout','HomeController@store_checkout')->name('store_checkout');

Route::get('/payment/{id}','HomeController@store_payment')->name('store_payment');
Route::get('/payment','HomeController@payment')->name('payment');

Route::get('/reset','HomeController@reset')->name('reset');

Route::post('/midtrans/{selection}',function ($selection)
{
});
Route::post('/midtrans/success','GuestController@notification')->name('notification');