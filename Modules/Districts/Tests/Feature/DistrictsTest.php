<?php

use Modules\Districts\Models\District;

uses(Tests\TestCase::class);

test('can see district list', function() {
    $this->authenticate();
   $this->get(route('app.districts.index'))->assertOk();
});

test('can see district create page', function() {
    $this->authenticate();
   $this->get(route('app.districts.create'))->assertOk();
});

test('can create district', function() {
    $this->authenticate();
   $this->post(route('app.districts.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.districts.index'));

   $this->assertDatabaseCount('districts', 1);
});

test('can see district edit page', function() {
    $this->authenticate();
    $district = District::factory()->create();
    $this->get(route('app.districts.edit', $district->id))->assertOk();
});

test('can update district', function() {
    $this->authenticate();
    $district = District::factory()->create();
    $this->patch(route('app.districts.update', $district->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.districts.index'));

    $this->assertDatabaseHas('districts', ['name' => 'Joe Smith']);
});

test('can delete district', function() {
    $this->authenticate();
    $district = District::factory()->create();
    $this->delete(route('app.districts.delete', $district->id))->assertRedirect(route('app.districts.index'));

    $this->assertDatabaseCount('districts', 0);
});