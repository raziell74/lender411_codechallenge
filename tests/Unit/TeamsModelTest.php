<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamsModelTest extends TestCase
{
    public function testTeamNamesAreUnique() {
        $error_code = null;
        try {
            factory(\App\Team::class, 2)->create([
                'name' => 'Shablagoo'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
        }

        $this->assertDatabaseHas('teams', [
            'name' => 'Shablagoo'
        ]);
        $this->assertEquals($error_code, 1062);
    }

    public function testGetsPlayers() {
        factory(\App\Team::class)->create([
            'name' => 'Shablagoo'
        ])->each(function($team) {
            $team->players()->saveMany(factory('App\Player', 4)->make());
        });

        $team = \App\Team::where('name', 'Shablagoo')->first();

        $this->assertEquals($team->players()->count(), 4);
    }
}
