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
Route::get('teams/{team}', 'TeamController@get')->middleware('scope:view-teams');
Route::post('teams', 'TeamController@add')->middleware('scope:add-teams');
Route::delete('teams/{team}', 'TeamController@delete')->middleware('scope:delete-teams');

Route::get('players', 'PlayerController@getAll')->middleware('scope:view-players');
Route::get('players/{player}', 'PlayerController@get')->middleware('scope:view-players');
Route::post('players', 'PlayerController@add')->middleware('scope:add-players');
Route::put('players', 'PlayerController@update')->middleware('scope:update-players');
Route::delete('players/{team}', 'PlayerController@delete')->middleware('scope:delete-players');