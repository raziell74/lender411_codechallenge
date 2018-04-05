<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamApiEndpointsTest extends TestCase
{
    public function testTeamsAreCreatedCorrectly() {
        $user = Passport::actingAs(
            factory(\App\User::class)->create(),
            ['add-teams']
        );
        $token = $user->accessToken;
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
}
