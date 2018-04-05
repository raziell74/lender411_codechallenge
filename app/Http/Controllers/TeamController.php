<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index() {
        return Team::all();
    }

    public function show(Team $team) {
        return $team;
    }

    public function add(Request $request) {
        $team = Team::create($request->all());
        $team->players()->createMany($request->input('players'));
        return response()->json($team, 201);
    }

    public function update(Request $request, Team $team) {
        $team->update($request->all());
        return response()->json($team, 200);
    }

    public function delete(Team $team) {
        $team->delete();
        return response()->json(null, 204);
    }
}
