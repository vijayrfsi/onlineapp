<?php

use Modules\Degrees\Models\Degree;

uses(Tests\TestCase::class);

test('can see degree list', function() {
    $this->authenticate();
   $this->get(route('app.degrees.index'))->assertOk();
});

test('can see degree create page', function() {
    $this->authenticate();
   $this->get(route('app.degrees.create'))->assertOk();
});

test('can create degree', function() {
    $this->authenticate();
   $this->post(route('app.degrees.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.degrees.index'));

   $this->assertDatabaseCount('degrees', 1);
});

test('can see degree edit page', function() {
    $this->authenticate();
    $degree = Degree::factory()->create();
    $this->get(route('app.degrees.edit', $degree->id))->assertOk();
});

test('can update degree', function() {
    $this->authenticate();
    $degree = Degree::factory()->create();
    $this->patch(route('app.degrees.update', $degree->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.degrees.index'));

    $this->assertDatabaseHas('degrees', ['name' => 'Joe Smith']);
});

test('can delete degree', function() {
    $this->authenticate();
    $degree = Degree::factory()->create();
    $this->delete(route('app.degrees.delete', $degree->id))->assertRedirect(route('app.degrees.index'));

    $this->assertDatabaseCount('degrees', 0);
});