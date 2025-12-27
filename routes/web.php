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

    $group = \App\Models\Group::create([
    'name' => request('name'),
    ]);

    //dd($group->id);
    $attributes = User::find(1);

    $attributes->groups()->attach($group->id);

    return redirect('/home');
});

Route::get('/groups/create', function () {
    return view('groups.create');
});

Route::get('/', function () {
    return view('welcome');
});
