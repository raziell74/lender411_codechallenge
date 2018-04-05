<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayerApiEndpoints extends TestCase
{
    public function testPlayersAreCreatedCorrectly() {
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];
        $team = factory(\App\Team::class)->create();
        $payload = [
            'first_name' => 'Jordan',
            'last_name'  => 'Richmeier',
            'team_id' => $team->id
        ];

        $response = $this->json('POST', '/api/players', $payload, $headers);
        $output = json_decode($response->content(), true);

        $response->assertStatus(201);
        $this->assertNotEmpty($output['team']);
        $this->assertEquals($output['first_name'], 'Jordan');
        $this->assertEquals($output['last_name'], 'Richmeier');
    }

    public function testUpdatePlayers() {
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];
        $player = factory(\App\Player::class)->create([
            'first_name' => 'Bill',
            'last_name' => 'Brasky'
        ]);
        $payload = ['first_name' => 'Jordan'];

        $response = $this->json('PUT', "/api/players/{$player->id}", $payload, $headers);
        $output = json_decode($response->content(), true);
        $dbPlayer = \App\Player::find($output['id']);

        $response->assertStatus(201);
        $this->assertEquals($dbPlayer->first_name, 'Jordan');
        $this->assertEquals($output['first_name'], 'Jordan');
    }

    public function testDeletePlayer() {
        $player = factory(\App\Player::class)->create([
            'first_name' => 'Bill',
            'last_name' => 'Brasky'
        ]);
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('DELETE', "/api/players/{$player->id}", $headers);
        $deleted_player = \App\Team::find($player->id);

        $response->assertStatus(204);
        $this->assertNull($deleted_player);
    }

    public function testGetPlayer() {
        $player = factory(\App\Player::class)->create(['first_name' => 'Jordan']);
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', "/api/players/{$player->id}", $headers);
        $output = json_decode($response->content(), true);

        $response->assertStatus(200);
        $this->assertEquals($output['first_name'], 'Jordan');
    }

    public function testGetAllPlayers() {
        factory(\App\Player::class, 10)->create();
        $token = $this->getOAuthToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', "/api/players", $headers);
        $output = json_decode($response->content(), true);

        $response->assertStatus(200);
        $this->assertCount(10, $output);
    }

    private function getOAuthToken() {
        return Passport::actingAs(
            factory(\App\User::class)->create(),
            [
                'add-players',
                'update-players',
                'delete-players',
                'view-players'
            ]
        )->accessToken;
    }
}
