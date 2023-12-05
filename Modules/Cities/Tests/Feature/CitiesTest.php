<?php

use Modules\Cities\Models\City;

uses(Tests\TestCase::class);

test('can see city list', function() {
    $this->authenticate();
   $this->get(route('app.cities.index'))->assertOk();
});

test('can see city create page', function() {
    $this->authenticate();
   $this->get(route('app.cities.create'))->assertOk();
});

test('can create city', function() {
    $this->authenticate();
   $this->post(route('app.cities.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.cities.index'));

   $this->assertDatabaseCount('cities', 1);
});

test('can see city edit page', function() {
    $this->authenticate();
    $city = City::factory()->create();
    $this->get(route('app.cities.edit', $city->id))->assertOk();
});

test('can update city', function() {
    $this->authenticate();
    $city = City::factory()->create();
    $this->patch(route('app.cities.update', $city->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.cities.index'));

    $this->assertDatabaseHas('cities', ['name' => 'Joe Smith']);
});

test('can delete city', function() {
    $this->authenticate();
    $city = City::factory()->create();
    $this->delete(route('app.cities.delete', $city->id))->assertRedirect(route('app.cities.index'));

    $this->assertDatabaseCount('cities', 0);
});