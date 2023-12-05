<?php

use Modules\FsiMenuItems\Models\FsiMenuItem;

uses(Tests\TestCase::class);

test('can see fsimenuitem list', function() {
    $this->authenticate();
   $this->get(route('app.fsi_menu_items.index'))->assertOk();
});

test('can see fsimenuitem create page', function() {
    $this->authenticate();
   $this->get(route('app.fsi_menu_items.create'))->assertOk();
});

test('can create fsimenuitem', function() {
    $this->authenticate();
   $this->post(route('app.fsi_menu_items.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.fsi_menu_items.index'));

   $this->assertDatabaseCount('fsi_menu_items', 1);
});

test('can see fsimenuitem edit page', function() {
    $this->authenticate();
    $fsimenuitem = FsiMenuItem::factory()->create();
    $this->get(route('app.fsi_menu_items.edit', $fsimenuitem->id))->assertOk();
});

test('can update fsimenuitem', function() {
    $this->authenticate();
    $fsimenuitem = FsiMenuItem::factory()->create();
    $this->patch(route('app.fsi_menu_items.update', $fsimenuitem->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.fsi_menu_items.index'));

    $this->assertDatabaseHas('fsi_menu_items', ['name' => 'Joe Smith']);
});

test('can delete fsimenuitem', function() {
    $this->authenticate();
    $fsimenuitem = FsiMenuItem::factory()->create();
    $this->delete(route('app.fsi_menu_items.delete', $fsimenuitem->id))->assertRedirect(route('app.fsi_menu_items.index'));

    $this->assertDatabaseCount('fsi_menu_items', 0);
});