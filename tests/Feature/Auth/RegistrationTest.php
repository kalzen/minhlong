<?php

test('registration is disabled', function () {
    $response = $this->get('/register');

    $response->assertNotFound();
});

test('registration post is not accepted', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertNotFound();
});
