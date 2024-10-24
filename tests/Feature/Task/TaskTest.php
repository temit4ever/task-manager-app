<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

uses(RefreshDatabase::class);

it('display task form fields', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->getJson(route('create.task'));
    $response
        ->assertSee('Create Task')
        ->assertStatus(200);
});

it('can not create a task without a name field', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson(route('store.task'), []);
    $response->assertStatus(422);
});
it('can not create a task without a priority field', function () {

    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson(route('store.task'), []);
    $response->assertStatus(422);
});
it('can not create a task without a project ID field', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson(route('store.task'), []);
    $response->assertStatus(422);
});

it('can create a task with necessary fields', function () {
    $user = User::factory()->create();
    Project::factory()->create();
    Task::factory()->create();
    $this->actingAs($user)->postJson(route('store.task'), [
        'task_name' => 'Test Task',
        'priority' =>1,
        'project_id' => 1
    ])
        ->assertRedirect()
        ->assertValid();
    $this->assertDatabaseHas('tasks', ['name' => 'Test Task']);
});

it('can update a task', function () {
    $user = User::factory()->create();
    Project::factory()->create();
    $task = Task::factory()->create();
    $response = $this->actingAs($user)->postJson(route('store.task', $task->id), [
        'task_name' => 'Test Task Updated',
        'priority' => 1,
        'project_id' => 1
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('tasks', ['name' => 'Test Task Updated']);
});
it('can delete a task', function () {
    $user = User::factory()->create();
    Project::factory()->create();
    $task = Task::factory()->create();
    $response = $this->actingAs($user)->deleteJson(route('delete.task', $task->id));
    $response->assertRedirect();
    $this->assertCount(0, Task::all());
});
