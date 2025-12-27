<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get(
    '/home',
    function () {
    return view('home');
}
)->middleware('auth');

Route::get('/signin/angello', function () {
    auth()->login(\App\Models\User::first());
    return redirect('home');
});

Route::post('/groups', function () {

    request()->validate([
        'name' => 'required',
    ]);

    \App\Models\Group::create([
    'name' => request('name'),
    ]);
});

Route::get('/groups/create', function () {
    return view('groups.create');
});

Route::get('/', function () {
    return view('welcome');
});
