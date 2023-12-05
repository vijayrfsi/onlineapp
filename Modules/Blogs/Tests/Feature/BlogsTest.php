<?php

use Modules\Blogs\Models\Blog;

uses(Tests\TestCase::class);

test('can see blog list', function() {
    $this->authenticate();
   $this->get(route('app.blogs.index'))->assertOk();
});

test('can see blog create page', function() {
    $this->authenticate();
   $this->get(route('app.blogs.create'))->assertOk();
});

test('can create blog', function() {
    $this->authenticate();
   $this->post(route('app.blogs.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.blogs.index'));

   $this->assertDatabaseCount('blogs', 1);
});

test('can see blog edit page', function() {
    $this->authenticate();
    $blog = Blog::factory()->create();
    $this->get(route('app.blogs.edit', $blog->id))->assertOk();
});

test('can update blog', function() {
    $this->authenticate();
    $blog = Blog::factory()->create();
    $this->patch(route('app.blogs.update', $blog->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.blogs.index'));

    $this->assertDatabaseHas('blogs', ['name' => 'Joe Smith']);
});

test('can delete blog', function() {
    $this->authenticate();
    $blog = Blog::factory()->create();
    $this->delete(route('app.blogs.delete', $blog->id))->assertRedirect(route('app.blogs.index'));

    $this->assertDatabaseCount('blogs', 0);
});