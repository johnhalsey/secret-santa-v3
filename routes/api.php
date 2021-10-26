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

Route::post('/groups/{group}/members', [\App\Http\Controllers\Api\GroupMemberController::class, 'store'])
    ->name('api.group.members.store');

Route::delete('/groups/{group}/members/{member}', [\App\Http\Controllers\Api\GroupMemberController::class, 'destroy'])
    ->name('api.group.members.destroy');
