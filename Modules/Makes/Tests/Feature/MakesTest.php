<?php

use Modules\Makes\Models\Make;

uses(Tests\TestCase::class);

test('can see make list', function() {
    $this->authenticate();
   $this->get(route('app.makes.index'))->assertOk();
});

test('can see make create page', function() {
    $this->authenticate();
   $this->get(route('app.makes.create'))->assertOk();
});

test('can create make', function() {
    $this->authenticate();
   $this->post(route('app.makes.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.makes.index'));

   $this->assertDatabaseCount('makes', 1);
});

test('can see make edit page', function() {
    $this->authenticate();
    $make = Make::factory()->create();
    $this->get(route('app.makes.edit', $make->id))->assertOk();
});

test('can update make', function() {
    $this->authenticate();
    $make = Make::factory()->create();
    $this->patch(route('app.makes.update', $make->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.makes.index'));

    $this->assertDatabaseHas('makes', ['name' => 'Joe Smith']);
});

test('can delete make', function() {
    $this->authenticate();
    $make = Make::factory()->create();
    $this->delete(route('app.makes.delete', $make->id))->assertRedirect(route('app.makes.index'));

    $this->assertDatabaseCount('makes', 0);
});