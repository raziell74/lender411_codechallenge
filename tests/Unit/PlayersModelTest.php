<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayersModel extends TestCase {
    public function testNoDuplicatePlayers() {
        $error_code = null;
        factory(\App\Team::class)->create()->each(
            function($team) use(&$error_code) {
                try {
                    $team->players()->saveMany(factory('App\Player', 2)->make([
                        'first_name' => 'MintBerry',
                        'last_name'  => 'Crunch'
                    ]));
                } catch (\Illuminate\Database\QueryException $e) {
                    $error_code = $e->errorInfo[1];
                }
            }
        );

        $this->assertDatabaseHas('players', [
            'first_name' => 'MintBerry',
            'last_name'  => 'Crunch'
        ]);
        $this->assertEquals($error_code, 1062);
    }

    public function testGetTeam() {
        factory(\App\Team::class)->create([
            'name' => 'Coon and Friends'
        ])->each(function($team) {
            $team->players()->save(factory('App\Player')->make([
                'first_name' => 'MintBerry',
                'last_name'  => 'Crunch'
            ]));
        });
        
        $player = \App\Player::where('first_name', 'MintBerry')
            ->where('last_name', 'Crunch')
            ->first();

        $this->assertEquals($player->team->name, 'Coon and Friends');
    }
}
