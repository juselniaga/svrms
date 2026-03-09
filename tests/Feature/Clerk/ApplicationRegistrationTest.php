<?php

use App\Enums\UserRole;
use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->clerk = User::factory()->create(['role' => UserRole::Clerk]);
});

test('clerk can view the application registration form', function () {
    $this->actingAs($this->clerk)
        ->get(route('clerk.applications.create'))
        ->assertStatus(200)
        ->assertSee('Register New Application');
});

test('clerk can register a new application with valid data', function () {
    $payload = [
        'developer' => [
            'name' => 'Test Developer',
            'email' => 'dev@example.com',
            'tel' => '0123456789',
            'address1' => '123 Test Street',
            'poskod' => '12345',
            'city' => 'Test City',
            'state' => 'Test State',
        ],
        'application' => [
            'tajuk' => 'Test Project',
            'lokasi' => 'Test Location',
            'no_fail' => 'FILE/2026/001',
        ],
    ];

    $response = $this->actingAs($this->clerk)
        ->post(route('clerk.applications.store'), $payload);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('clerk.dashboard'));

    $this->assertDatabaseHas('developers', [
        'name' => 'Test Developer',
        'email' => 'dev@example.com',
    ]);

    $this->assertDatabaseHas('applications', [
        'tajuk' => 'Test Project',
        'status' => 'RECORDED',
    ]);

    $application = Application::first();
    expect($application->reference_no)->not->toBeNull();
    expect($application->reference_no)->toContain('SVRMS-'.now()->year);
});

test('validation errors are returned for missing mandatory fields', function () {
    $response = $this->actingAs($this->clerk)
        ->post(route('clerk.applications.store'), []);

    $response->assertSessionHasErrors([
        'developer.name',
        'developer.email',
        'application.tajuk',
        'application.lokasi',
    ]);
});
