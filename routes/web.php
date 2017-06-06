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

Route::get('adminLogin', function () {
    return view('admin/auth/login');
});

Route::get('gudangLogin', function () {
    return view('gudang/auth/login');
});

Route::get('kasirLogin', function () {
    return view('kasir/auth/login');
});

Route::get('inputbarang', function () {
  return view('admin/inputbarang');
});

Route::get('penjualan', function () {
    return view('kasir/penjualan');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::post('inputbarang', 'barangController@store');
Route::post('penjualan/cek', 'barangController@cek')->name('cek');
Route::post('penjualan', 'barangController@jual')->name('jual');

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'kasir'], function () {
  Route::get('/login', 'KasirAuth\LoginController@showLoginForm');
  Route::post('/login', 'KasirAuth\LoginController@login');
  Route::post('/logout', 'KasirAuth\LoginController@logout');

  Route::get('/register', 'KasirAuth\RegisterController@showRegistrationForm');
  Route::post('/register', 'KasirAuth\RegisterController@register');

  Route::post('/password/email', 'KasirAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'KasirAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'KasirAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'KasirAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'gudang'], function () {
  Route::get('/login', 'GudangAuth\LoginController@showLoginForm');
  Route::post('/login', 'GudangAuth\LoginController@login');
  Route::post('/logout', 'GudangAuth\LoginController@logout');

  Route::get('/register', 'GudangAuth\RegisterController@showRegistrationForm');
  Route::post('/register', 'GudangAuth\RegisterController@register');

  Route::post('/password/email', 'GudangAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'GudangAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'GudangAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'GudangAuth\ResetPasswordController@showResetForm');
});
