<?php

use App\Http\Controllers\GroupsController;
use App\Mail\Invite;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/signin/angello', function () {
    auth()->login(\App\Models\User::find(1));

    return redirect('home');
});

Route::get('/signin/mich', function () {
    auth()->login(\App\Models\User::find(2));

    return redirect('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {

        $groups = Group::whereAttachedTo(Auth::user())->get();

        return view('home', ['groups' => $groups]);
    });

    Route::post('groups', [GroupsController::class, 'store'])->name('groups.store');
});

Route::get('/groups/create', function () {
    return view('groups.create');
});

Route::get('/groups/{group}', function (Group $group) {
    if ($group->users->doesntContain(Auth::user())) {
        abort(404);
    }

    return view('groups.show', [
        'group' => $group,
        'users' => $group->users()->get(),
    ]);
})->name('groups.show');

Route::post('/groups/{group}/people', function (Group $group) {
    // if user exists in hatihati, add to group
    if (User::where('email', request('email'))->exists()) {
        $user = User::where('email', request('email'))->first();

        $group->users()->syncWithoutDetaching($user);

        return redirect()->back();
    }

    // if not user exists
    // create their account without a password and name
    // add them to the group
    // send them an invite
    if (User::where('email', request('email'))->doesntExist()) {
        $user = User::create([
            'email' => request('email'),
        ]);

        $user->groups()->syncWithoutDetaching($group);

        Mail::to($user)->send(new Invite);

        dd('doesn exist');
    }
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
