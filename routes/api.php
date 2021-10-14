<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/groups', [\App\Http\Controllers\Api\GroupController::class, 'store'])
    ->name('api.groups.store');

Route::post('/group/{group}/users', [\App\Http\Controllers\Api\GroupMemberController::class, 'store'])
    ->name('api.group.user.store');
