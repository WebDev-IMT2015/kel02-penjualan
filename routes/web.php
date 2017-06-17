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

Route::get('inputbarang', function () {
	return view('admin/inputbarang');
});

Route::get('penjualan', function () {
	return view('kasir/penjualan');
});

Route::post('inputbarang', 'barangController@store');
Route::post('penjualan/cek', 'barangController@cek')->name('cek');
Route::post('penjualan', 'barangController@jual')->name('jual');
