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

Route::post('/add-team', function (Request $request) {
    return App\Team::create($request->all());
})->middleware('scope:add-team');

Route::put('/update-team', function (Request $request, $id) {
    $team = App\Team::findOrFail($id);
    $team->update($request->all());

    return $team;
})->middleware('scope:update-team');

Route::put('/delete-team', function ($id) {
    App\Team::find($id)->delete();

    return 204;
})->middleware('scope:delete-team');

Route::get('/add-player', function (Request $request) {
    return $request->user();
})->middleware('scope:add-player');

Route::get('/update-player', function (Request $request) {
    return $request->user();
})->middleware('scope:update-player');

Route::get('/get-team-players', function (Request $request) {
    return $request->user();
})->middleware('scope:get-team-players');