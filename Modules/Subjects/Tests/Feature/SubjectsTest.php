<?php

use Modules\Subjects\Models\Subject;

uses(Tests\TestCase::class);

test('can see subject list', function() {
    $this->authenticate();
   $this->get(route('app.subjects.index'))->assertOk();
});

test('can see subject create page', function() {
    $this->authenticate();
   $this->get(route('app.subjects.create'))->assertOk();
});

test('can create subject', function() {
    $this->authenticate();
   $this->post(route('app.subjects.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.subjects.index'));

   $this->assertDatabaseCount('subjects', 1);
});

test('can see subject edit page', function() {
    $this->authenticate();
    $subject = Subject::factory()->create();
    $this->get(route('app.subjects.edit', $subject->id))->assertOk();
});

test('can update subject', function() {
    $this->authenticate();
    $subject = Subject::factory()->create();
    $this->patch(route('app.subjects.update', $subject->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.subjects.index'));

    $this->assertDatabaseHas('subjects', ['name' => 'Joe Smith']);
});

test('can delete subject', function() {
    $this->authenticate();
    $subject = Subject::factory()->create();
    $this->delete(route('app.subjects.delete', $subject->id))->assertRedirect(route('app.subjects.index'));

    $this->assertDatabaseCount('subjects', 0);
});