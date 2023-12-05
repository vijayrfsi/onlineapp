<?php

use Modules\States\Models\State;

uses(Tests\TestCase::class);

test('can see state list', function() {
    $this->authenticate();
   $this->get(route('app.states.index'))->assertOk();
});

test('can see state create page', function() {
    $this->authenticate();
   $this->get(route('app.states.create'))->assertOk();
});

test('can create state', function() {
    $this->authenticate();
   $this->post(route('app.states.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.states.index'));

   $this->assertDatabaseCount('states', 1);
});

test('can see state edit page', function() {
    $this->authenticate();
    $state = State::factory()->create();
    $this->get(route('app.states.edit', $state->id))->assertOk();
});

test('can update state', function() {
    $this->authenticate();
    $state = State::factory()->create();
    $this->patch(route('app.states.update', $state->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.states.index'));

    $this->assertDatabaseHas('states', ['name' => 'Joe Smith']);
});

test('can delete state', function() {
    $this->authenticate();
    $state = State::factory()->create();
    $this->delete(route('app.states.delete', $state->id))->assertRedirect(route('app.states.index'));

    $this->assertDatabaseCount('states', 0);
});