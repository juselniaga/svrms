<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::get('/clerk-only', function () {
        return 'clerk area';
    })->middleware(['auth', 'role:Clerk']);

    Route::get('/director-only', function () {
        return 'director area';
    })->middleware(['auth', 'role:Director']);
});

test('role middleware allows access to users with the correct role', function () {
    $clerk = User::factory()->create(['role' => UserRole::Clerk]);

    $this->actingAs($clerk)
        ->get('/clerk-only')
        ->assertStatus(200)
        ->assertSee('clerk area');
});

test('role middleware denies access to users with an incorrect role', function () {
    $developer = User::factory()->create(['role' => UserRole::Developer]);

    $this->actingAs($developer)
        ->get('/clerk-only')
        ->assertStatus(403)
        ->assertSee('Unauthorized action.');
});

test('role middleware denies access to unauthenticated users', function () {
    $this->get('/clerk-only')
        ->assertRedirect('/login');
});
