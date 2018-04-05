<?php

use Illuminate\Http\Request;

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

Route::get('/add-team', function (Request $request) {
    return $request->user();
})->middleware('scope:add-team');

Route::get('/update-team', function (Request $request) {
    return $request->user();
})->middleware('scope:update-team');

Route::get('/add-player', function (Request $request) {
    return $request->user();
})->middleware('scope:add-player');

Route::get('/update-player', function (Request $request) {
    return $request->user();
})->middleware('scope:update-player');

Route::get('/get-team-players', function (Request $request) {
    return $request->user();
})->middleware('scope:get-team-players');