<?php

use Modules\Countries\Models\Country;

uses(Tests\TestCase::class);

test('can see country list', function() {
    $this->authenticate();
   $this->get(route('app.countries.index'))->assertOk();
});

test('can see country create page', function() {
    $this->authenticate();
   $this->get(route('app.countries.create'))->assertOk();
});

test('can create country', function() {
    $this->authenticate();
   $this->post(route('app.countries.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.countries.index'));

   $this->assertDatabaseCount('countries', 1);
});

test('can see country edit page', function() {
    $this->authenticate();
    $country = Country::factory()->create();
    $this->get(route('app.countries.edit', $country->id))->assertOk();
});

test('can update country', function() {
    $this->authenticate();
    $country = Country::factory()->create();
    $this->patch(route('app.countries.update', $country->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.countries.index'));

    $this->assertDatabaseHas('countries', ['name' => 'Joe Smith']);
});

test('can delete country', function() {
    $this->authenticate();
    $country = Country::factory()->create();
    $this->delete(route('app.countries.delete', $country->id))->assertRedirect(route('app.countries.index'));

    $this->assertDatabaseCount('countries', 0);
});