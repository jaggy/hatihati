<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get(
    '/home',
    function () {

        $groups = Group::whereAttachedTo(Auth::user())->get();

        return view('home', ['groups' => $groups]);
    }
)->middleware('auth');

Route::get('/signin/angello', function () {
    auth()->login(\App\Models\User::find(1));
    return redirect('home');
});

Route::get('/signin/mich', function () {
    auth()->login(\App\Models\User::find(2));
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
    Auth::user()->groups()->attach($group->id);

    return redirect('/home');
});

Route::get('/groups/create', function () {
    return view('groups.create');
});

Route::get('/', function () {
    return view('welcome');
});
