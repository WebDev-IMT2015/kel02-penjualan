<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('kasir')->user();

    //dd($users);

    return view('kasir.home');
})->name('home');

