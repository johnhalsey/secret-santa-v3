<?php

use App\Http\Controllers\GroupController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('register', function () {
    Fortify::registerView(function () {
        return Inertia::render('Auth/Register');
    });
});
