<?php

use Modules\Marks\Models\Mark;

uses(Tests\TestCase::class);

test('can see mark list', function() {
    $this->authenticate();
   $this->get(route('app.marks.index'))->assertOk();
});

test('can see mark create page', function() {
    $this->authenticate();
   $this->get(route('app.marks.create'))->assertOk();
});

test('can create mark', function() {
    $this->authenticate();
   $this->post(route('app.marks.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.marks.index'));

   $this->assertDatabaseCount('marks', 1);
});

test('can see mark edit page', function() {
    $this->authenticate();
    $mark = Mark::factory()->create();
    $this->get(route('app.marks.edit', $mark->id))->assertOk();
});

test('can update mark', function() {
    $this->authenticate();
    $mark = Mark::factory()->create();
    $this->patch(route('app.marks.update', $mark->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.marks.index'));

    $this->assertDatabaseHas('marks', ['name' => 'Joe Smith']);
});

test('can delete mark', function() {
    $this->authenticate();
    $mark = Mark::factory()->create();
    $this->delete(route('app.marks.delete', $mark->id))->assertRedirect(route('app.marks.index'));

    $this->assertDatabaseCount('marks', 0);
});