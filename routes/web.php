<?php

use Illuminate\Support\Facades\Route;

Route::get(
    '/home',
    function () {
    dd('hello');
    return view('welcome');
}
)->middleware('auth');

Route::get('/signin/angello', function () {
    auth()->login(\App\Models\User::first());
    return redirect('home');
});

Route::get('/', function () {
    return view('welcome');
});
