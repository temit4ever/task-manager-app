<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('display project form fields', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->getJson(route('create.project'));
    $response
        ->assertSee('Create Task')
        ->assertStatus(200);
});
