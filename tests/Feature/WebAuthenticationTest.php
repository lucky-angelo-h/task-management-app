<?php

use App\Models\User;

it('can register a new user', function () {
    $response = $this->post('/register', [
        'name' => 'Lucky Me',
        'email' => 'luckyme@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('users', ['email' => 'luckyme@example.com']);
});

it('can login with correct credentials', function () {
    $user = User::factory()->create([
        'email' => 'luckyme@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});
