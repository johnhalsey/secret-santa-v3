<?php

use App\Http\Controllers\GroupController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('guest')->get('/', function() {});

Route::get('groups', [GroupController::class, 'index'])
    ->name('groups');

Route::get('groups/{group}', [GroupController::class, 'show'])
    ->name('group.show');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
