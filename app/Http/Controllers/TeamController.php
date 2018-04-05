<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function getAll() {
        return Team::all();
    }

    public function get(Team $team) {
        return $team;
    }

    public function add(Request $request) {
        $team = Team::create($request->all());
        $team->players()->createMany($request->input('players'));
        return response()->json($team, 201);
    }

    public function delete(Team $team) {
        $team->delete();
        return response()->json(null, 204);
    }
}
