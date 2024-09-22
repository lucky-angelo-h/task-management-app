<?php

use App\Models\User;

it('can register a user via the API', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Lucky Me',
        'email' => 'luckymeapi@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(201)->assertJsonStructure(['token']);
    $this->assertDatabaseHas('users', ['email' => 'luckymeapi@example.com']);
});

it('can login via the API', function () {
    $user = User::factory()->create(['password' => bcrypt('password')]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertStatus(200)->assertJsonStructure(['token']);
});
