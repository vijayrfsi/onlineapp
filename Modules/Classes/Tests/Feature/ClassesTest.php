<?php

use Modules\Classes\Models\Class;

uses(Tests\TestCase::class);

test('can see class list', function() {
    $this->authenticate();
   $this->get(route('app.classes.index'))->assertOk();
});

test('can see class create page', function() {
    $this->authenticate();
   $this->get(route('app.classes.create'))->assertOk();
});

test('can create class', function() {
    $this->authenticate();
   $this->post(route('app.classes.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.classes.index'));

   $this->assertDatabaseCount('classes', 1);
});

test('can see class edit page', function() {
    $this->authenticate();
    $class = Class::factory()->create();
    $this->get(route('app.classes.edit', $class->id))->assertOk();
});

test('can update class', function() {
    $this->authenticate();
    $class = Class::factory()->create();
    $this->patch(route('app.classes.update', $class->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.classes.index'));

    $this->assertDatabaseHas('classes', ['name' => 'Joe Smith']);
});

test('can delete class', function() {
    $this->authenticate();
    $class = Class::factory()->create();
    $this->delete(route('app.classes.delete', $class->id))->assertRedirect(route('app.classes.index'));

    $this->assertDatabaseCount('classes', 0);
});