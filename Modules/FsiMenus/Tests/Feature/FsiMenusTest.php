<?php

use Modules\FsiMenus\Models\FsiMenu;

uses(Tests\TestCase::class);

test('can see fsimenu list', function() {
    $this->authenticate();
   $this->get(route('app.fsi_menus.index'))->assertOk();
});

test('can see fsimenu create page', function() {
    $this->authenticate();
   $this->get(route('app.fsi_menus.create'))->assertOk();
});

test('can create fsimenu', function() {
    $this->authenticate();
   $this->post(route('app.fsi_menus.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.fsi_menus.index'));

   $this->assertDatabaseCount('fsi_menus', 1);
});

test('can see fsimenu edit page', function() {
    $this->authenticate();
    $fsimenu = FsiMenu::factory()->create();
    $this->get(route('app.fsi_menus.edit', $fsimenu->id))->assertOk();
});

test('can update fsimenu', function() {
    $this->authenticate();
    $fsimenu = FsiMenu::factory()->create();
    $this->patch(route('app.fsi_menus.update', $fsimenu->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.fsi_menus.index'));

    $this->assertDatabaseHas('fsi_menus', ['name' => 'Joe Smith']);
});

test('can delete fsimenu', function() {
    $this->authenticate();
    $fsimenu = FsiMenu::factory()->create();
    $this->delete(route('app.fsi_menus.delete', $fsimenu->id))->assertRedirect(route('app.fsi_menus.index'));

    $this->assertDatabaseCount('fsi_menus', 0);
});