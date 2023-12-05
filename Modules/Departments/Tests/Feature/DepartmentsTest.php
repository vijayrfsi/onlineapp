<?php

use Modules\Departments\Models\Department;

uses(Tests\TestCase::class);

test('can see department list', function() {
    $this->authenticate();
   $this->get(route('app.departments.index'))->assertOk();
});

test('can see department create page', function() {
    $this->authenticate();
   $this->get(route('app.departments.create'))->assertOk();
});

test('can create department', function() {
    $this->authenticate();
   $this->post(route('app.departments.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.departments.index'));

   $this->assertDatabaseCount('departments', 1);
});

test('can see department edit page', function() {
    $this->authenticate();
    $department = Department::factory()->create();
    $this->get(route('app.departments.edit', $department->id))->assertOk();
});

test('can update department', function() {
    $this->authenticate();
    $department = Department::factory()->create();
    $this->patch(route('app.departments.update', $department->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.departments.index'));

    $this->assertDatabaseHas('departments', ['name' => 'Joe Smith']);
});

test('can delete department', function() {
    $this->authenticate();
    $department = Department::factory()->create();
    $this->delete(route('app.departments.delete', $department->id))->assertRedirect(route('app.departments.index'));

    $this->assertDatabaseCount('departments', 0);
});