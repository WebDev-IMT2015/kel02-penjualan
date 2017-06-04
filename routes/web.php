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

Route::get('inputbarang', function () {
	return view('admin/inputbarang');
});

Route::get('penjualan', function () {
    return view('kasir/penjualan');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('inputbarang', 'barangController@store');
Route::post('penjualan/cek', 'barangController@cek')->name('cek');
Route::post('penjualan', 'barangController@jual')->name('jual');

// admin
Route::get('admin_register', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('admin_register', 'AdminAuth\RegisterController@register');

Route::get('/admin_home', function(){
	return view('admin.home');
});

Route::post('admin_logout', 'AdminAuth\LoginController@logout');
Route::get('admin_login', 'AdminAuth\LoginController@showLoginForm');
Route::post('admin_login', 'AdminAuth\LoginController@login');

// gudang
Route::get('gudang_register', 'GudangAuth\RegisterController@showRegistrationForm');
Route::post('gudang_register', 'GudangAuth\RegisterController@register');

Route::get('/gudang_home', function(){
	return view('gudang.home');
});

Route::post('gudang_logout', 'GudangAuth\LoginController@logout');
Route::get('gudang_login', 'GudangAuth\LoginController@showLoginForm');
Route::post('gudang_login', 'GudangAuth\LoginController@login');

// kasir
Route::get('kasir_register', 'KasirAuth\RegisterController@showRegistrationForm');
Route::post('kasir_register', 'KasirAuth\RegisterController@register');

Route::get('/kasir_home', function(){
	return view('kasir.home');
});

Route::post('kasir_logout', 'KasirAuth\LoginController@logout');
Route::get('kasir_login', 'KasirAuth\LoginController@showLoginForm');
Route::post('kasir_login', 'KasirAuth\LoginController@login');

// middleware
//Logged in users cannot access or send requests these pages
Route::group(['middleware' => 'admin_guest'], function() {

	Route::get('admin_register', 'AdminAuth\RegisterController@showRegistrationForm');
	Route::post('admin_register', 'AdminAuth\RegisterController@register');
	Route::get('admin_login', 'AdminAuth\LoginController@showLoginForm');
	Route::post('admin_login', 'AdminAuth\LoginController@login');

});

Route::group(['middleware' => 'gudang_guest'], function() {

	Route::get('gudang_register', 'GudangAuth\RegisterController@showRegistrationForm');
	Route::post('gudang_register', 'GudangAuth\RegisterController@register');
	Route::get('gudang_login', 'GudangAuth\LoginController@showLoginForm');
	Route::post('gudang_login', 'GudangAuth\LoginController@login');

});

Route::group(['middleware' => 'kasir_guest'], function() {

	Route::get('kasir_register', 'KasirAuth\RegisterController@showRegistrationForm');
	Route::post('kasir_register', 'KasirAuth\RegisterController@register');
	Route::get('kasir_login', 'KasirAuth\LoginController@showLoginForm');
	Route::post('kasir_login', 'KasirAuth\LoginController@login');

});

//Only logged in users can access or send requests to these pages
Route::group(['middleware' => 'admin_auth'], function(){

	Route::post('admin_logout', 'AdminAuth\LoginController@logout');
	Route::get('/admin_home', function(){
		return view('admin.home');
	});

});

Route::group(['middleware' => 'gudang_auth'], function(){

	Route::post('gudang_logout', 'GudangAuth\LoginController@logout');
	Route::get('/gudang_home', function(){
		return view('gudang.home');
	});

});

Route::group(['middleware' => 'kasir_auth'], function(){

	Route::post('kasir_logout', 'KasirAuth\LoginController@logout');
	Route::get('/kasir_home', function(){
		return view('kasir.home');
	});

});