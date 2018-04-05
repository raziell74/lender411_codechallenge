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

Route::get('teams', 'TeamController@getAll')->middleware('scope:view-teams');
Route::get('teams/{id}', 'TeamController@get')->middleware('scope:view-teams');
Route::post('teams', 'TeamController@add')->middleware('scope:add-teams');
Route::put('teams/{id}', 'TeamController@update')->middleware('scope:update-teams');
Route::delete('teams/{id}', 'TeamController@delete')->middleware('scope:delete-teams');

Route::get('/add-player', function (Request $request) {
    return $request->user();
})->middleware('scope:add-player');

Route::get('/update-player', function (Request $request) {
    return $request->user();
})->middleware('scope:update-player');

Route::get('/get-team-players', function (Request $request) {
    return $request->user();
})->middleware('scope:get-team-players');