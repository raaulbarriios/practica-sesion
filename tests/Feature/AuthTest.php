<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('displays login page for guests', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
    $response->assertSee('Iniciar sesión');
    $response->assertSee('Correo electrónico');
    $response->assertSee('Contraseña');
});

test('logs in successfully with valid credentials and sets token and user name in session', function () {
    $user = User::factory()->create([
        'name' => 'Maria Garcia',
        'email' => 'maria@example.com',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->post(route('login.attempt'), [
        'email' => 'maria@example.com',
        'password' => 'secret123',
    ]);

    $response->assertRedirect('/');
    $response->assertSessionHas('token');
    $response->assertSessionHas('name', 'Maria Garcia');

    $token = session('token');
    expect($token)->not->toBeEmpty();
});

test('fails login with invalid password', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->from(route('login'))->post(route('login.attempt'), [
        'email' => 'test@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors('email');
    $response->assertSessionMissing('token');
    $response->assertSessionMissing('name');
});

test('fails login when email does not exist', function () {
    $response = $this->from(route('login'))->post(route('login.attempt'), [
        'email' => 'nonexistent@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors('email');
    $response->assertSessionMissing('token');
});

test('logs out by invalidating session and redirecting to login page', function () {
    $response = $this->withSession([
        'token' => 'sample-test-token',
        'name' => 'Maria Garcia',
    ])->post(route('logout'));

    $response->assertRedirect(route('login'));
    $response->assertSessionMissing('token');
    $response->assertSessionMissing('name');
});

test('displays login and register buttons in header when there is no session token', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Iniciar sesión');
    $response->assertSee('Crear cuenta');
    $response->assertDontSee('Cerrar sesión');
    $response->assertDontSee('Hola,');
});

test('displays user greeting and logout button in header when session token exists', function () {
    $response = $this->withSession([
        'token' => 'sample-active-token',
        'name' => 'Raúl',
    ])->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Hola, <span class="font-bold">Raúl</span>', false);
    $response->assertSee('Cerrar sesión');
    $response->assertDontSee('Iniciar sesión');
    $response->assertDontSee('Crear cuenta');
});

test('redirects user with active session away from login page', function () {
    $response = $this->withSession([
        'token' => 'sample-token',
        'name' => 'Raúl',
    ])->get(route('login'));

    $response->assertRedirect('/');
});

test('allows new user to register and sets session token and name', function () {
    $response = $this->post(route('register.attempt'), [
        'name' => 'Nuevo Usuario',
        'email' => 'nuevo@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/');
    $response->assertSessionHas('token');
    $response->assertSessionHas('name', 'Nuevo Usuario');

    $this->assertDatabaseHas('users', [
        'email' => 'nuevo@example.com',
        'name' => 'Nuevo Usuario',
    ]);
});
