<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;

class PlayerController extends Controller
{
    public function getAll() {
        return Player::all();
    }

    public function get(Player $player) {
        return $player;
    }

    public function add(Request $request) {
        $player = Player::create($request->all());
        if($request->input('team_id')) {
            $team = \App\Team::find($request->input('team_id'));
            if($team) {
                $player->team()->associate($team);
            } else {
                abort(
                    404,
                    'The Team was not found for id ' . $request->input('team_id')
                );
            }
        }
        return response()->json($player, 201);
    }

    public function update(Request $request, Player $player) {
        $player->update($request->all());
        if($request->input('team_id')) {
            $team = \App\Team::find($request->input('team_id'));
            if($team) {
                $player->team()->associate($team);
            } else {
                abort(
                    404,
                    'The Team was not found for id ' . $request->input('team_id')
                );
            }
        }else {
            $player->team()->dissociate();
        }
        return response()->json($player, 201);
    }

    public function delete(Player $player) {
        $player->delete();
        return response()->json(null, 204);
    }
}
