<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Uses the given trait in the current file
uses(RefreshDatabase::class);

test('User api endpoint works', function () {
    $response = $this->get('/users');

    $response->assertStatus(200);
});

test('Database works', function () {
    User::factory(20)->create();

    $this->assertEquals(20, User::all()->count());
});
