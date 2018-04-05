<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index() {
        return Team::all();
    }

    public function show($id) {
        return Team::find($id);
    }

    public function add(Request $request) {
        return Team::create($request->all());
    }

    public function update(Request $request, $id) {
        return Team::findOrFail($id)->update($request->all());
    }

    public function delete($id) {
        Team::findOrFail($id)->delete();
        return 204;
    }
}
