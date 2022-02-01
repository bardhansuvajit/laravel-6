<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('user')->name('user.')->group(function() {
    Route::middleware(['guest:web'])->group(function() {
        Route::view('/register', 'auth.register')->name('register');
        Route::post('/create', 'User\UserController@create')->name('create');
        Route::view('/login', 'auth.login')->name('login');
        Route::post('/check', 'User\UserController@check')->name('check');
    });

    Route::middleware(['auth:web'])->group(function() {
        Route::view('/home', 'user.home')->name('home');
    });
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::middleware(['guest:admin'])->group(function() {
        Route::view('/login', 'admin.auth.login')->name('login');
        Route::post('/check', 'Admin\AdminController@check')->name('login.check');
    });

    Route::middleware(['auth:admin'])->group(function() {
        // dashboard
        Route::view('/home', 'admin.home')->name('home');

        // profile
        Route::prefix('profile')->name('profile.')->group(function() {
            Route::view('/', 'admin.profile.index')->name('index');
            Route::post('/update', 'Admin\ProfileController@index')->name('update');
        });
    });
});

