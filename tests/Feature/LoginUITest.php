<?php

test('login screen has the purple-pearl design system CSS classes', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);

    // Purple gradient background
    $response->assertSee('from-indigo-100 via-purple-100 to-fuchsia-200');

    // Glassmorphism card
    $response->assertSee('backdrop-blur-xl border border-white/60');

    // Secure Login button
    $response->assertSee('Secure Login');
});
