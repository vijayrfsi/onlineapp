<?php

use Modules\Semesters\Models\Semester;

uses(Tests\TestCase::class);

test('can see semester list', function() {
    $this->authenticate();
   $this->get(route('app.semesters.index'))->assertOk();
});

test('can see semester create page', function() {
    $this->authenticate();
   $this->get(route('app.semesters.create'))->assertOk();
});

test('can create semester', function() {
    $this->authenticate();
   $this->post(route('app.semesters.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.semesters.index'));

   $this->assertDatabaseCount('semesters', 1);
});

test('can see semester edit page', function() {
    $this->authenticate();
    $semester = Semester::factory()->create();
    $this->get(route('app.semesters.edit', $semester->id))->assertOk();
});

test('can update semester', function() {
    $this->authenticate();
    $semester = Semester::factory()->create();
    $this->patch(route('app.semesters.update', $semester->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.semesters.index'));

    $this->assertDatabaseHas('semesters', ['name' => 'Joe Smith']);
});

test('can delete semester', function() {
    $this->authenticate();
    $semester = Semester::factory()->create();
    $this->delete(route('app.semesters.delete', $semester->id))->assertRedirect(route('app.semesters.index'));

    $this->assertDatabaseCount('semesters', 0);
});