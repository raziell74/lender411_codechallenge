<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamApiEndpointsTest extends TestCase
{
    public function testTeamsAreCreatedCorrectly() {
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'test name',
            'players' => [
                [
                    'first_name' => 'Jordan',
                    'last_name'  => 'Richmeier'
                ],
                [
                    'first_name' => 'Bill',
                    'last_name'  => 'Brasky'
                ]
            ]
        ];

        $response = $this->json('POST', '/api/teams', $payload, $headers);

        $response->assertStatus(201);
        $response->assertJson([
            'id' => 1,
            'name' => 'test name',
            'players' => [
                [
                    'id' => 1,
                    'first_name' => 'Jordan',
                    'last_name' => 'Richmeier',
                ],
                [
                    'id' => 2,
                    'first_name' => 'Bill',
                    'last_name'  => 'Brasky'
                ]
            ]
        ]);
    }

    public function testDeleteTeam() {
        $team = factory(\App\Team::class)->create([
            'name' => 'Shablagoo'
        ]);
        $team->players()->saveMany(factory('App\Player', 4)->make());
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('DELETE', "/api/teams/{$team->id}", $headers);
        $deleted_team = \App\Team::find($team->id);

        $response->assertStatus(204);
        $this->assertNull($deleted_team);
    }

    public function testGetTeam() {
        $team = factory(\App\Team::class)->create(['name' => 'Shablagoo']);
        $team->players()->saveMany(factory('App\Player', 4)->make());
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', "/api/teams/{$team->id}", $headers);
        $output = json_decode($response->content(), true);

        $response->assertStatus(200);
        $this->assertEquals($output['name'], 'Shablagoo');
        $this->assertCount(4, $output['players']);
    }

    public function testGetAllTeams() {
        factory(\App\Team::class, 10)->create()->each(function($team) {
            $team->players()->saveMany(factory('App\Player', 4)->make());
        });
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', "/api/teams", $headers);
        $output = json_decode($response->content(), true);

        $response->assertStatus(200);
        $this->assertCount(10, $output);
        $this->assertCount(4, $output[0]['players']);
    }

    private function getOAuthToken() {
        return Passport::actingAs(
            factory(\App\User::class)->create(),
            [
                'add-teams',
                'delete-teams',
                'view-teams'
            ]
        )->accessToken;
    }
}
