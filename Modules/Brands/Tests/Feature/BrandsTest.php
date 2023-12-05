<?php

use Modules\Brands\Models\Brand;

uses(Tests\TestCase::class);

test('can see brand list', function() {
    $this->authenticate();
   $this->get(route('app.brands.index'))->assertOk();
});

test('can see brand create page', function() {
    $this->authenticate();
   $this->get(route('app.brands.create'))->assertOk();
});

test('can create brand', function() {
    $this->authenticate();
   $this->post(route('app.brands.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.brands.index'));

   $this->assertDatabaseCount('brands', 1);
});

test('can see brand edit page', function() {
    $this->authenticate();
    $brand = Brand::factory()->create();
    $this->get(route('app.brands.edit', $brand->id))->assertOk();
});

test('can update brand', function() {
    $this->authenticate();
    $brand = Brand::factory()->create();
    $this->patch(route('app.brands.update', $brand->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.brands.index'));

    $this->assertDatabaseHas('brands', ['name' => 'Joe Smith']);
});

test('can delete brand', function() {
    $this->authenticate();
    $brand = Brand::factory()->create();
    $this->delete(route('app.brands.delete', $brand->id))->assertRedirect(route('app.brands.index'));

    $this->assertDatabaseCount('brands', 0);
});