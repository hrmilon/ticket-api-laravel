<?php

use App\Models\Ticket;
use App\Models\User;


it('can login with valid credentials', function () {


    // Create a user
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    // Attempt login with incorrect password
    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    // Assert that the response has a 401 status and an error message
    $response->assertStatus(200)
        ->assertJson(['data' => ['token' => true]]);
});


test('user can access /tickets/{id] with valid token', function () {
    // Create and authenticate the user
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create();

    $response = $this->actingAs($user, 'sanctum')->getJson('/api/v1/tickets/' . $ticket->id);

    // Assert the response
    $response->assertStatus(200)
        ->assertJsonStructure(
            [
                'data' => [
                    'attributes' => [
                        'title'
                    ]
                ]
            ]
        );

});
