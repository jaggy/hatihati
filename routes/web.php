<?php

use App\Models\Group;
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

    // dd($group->id);
    Auth::user()->groups()->attach($group->id);

    return redirect('/home');
});

Route::get('/groups/create', function () {
    return view('groups.create');
});

Route::get('/groups/{group}', function (Group $group) {
    if ($group->users->doesntContain(Auth::user())) {
        abort(404);
    }

    return view('groups.show', ['group' => $group]);
});

Route::post('/expenses', function () {

    $expense = \App\Models\Expense::create([
        'description' => request('description'),
        'amount' => request('amount'),
    ]);

    dd($expense);

    return redirect()->back();
});

Route::get('/', function () {
    return view('welcome');
});
