<?php

use Modules\Posts\Models\Post;

uses(Tests\TestCase::class);

test('can see post list', function() {
    $this->authenticate();
   $this->get(route('app.posts.index'))->assertOk();
});

test('can see post create page', function() {
    $this->authenticate();
   $this->get(route('app.posts.create'))->assertOk();
});

test('can create post', function() {
    $this->authenticate();
   $this->post(route('app.posts.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.posts.index'));

   $this->assertDatabaseCount('posts', 1);
});

test('can see post edit page', function() {
    $this->authenticate();
    $post = Post::factory()->create();
    $this->get(route('app.posts.edit', $post->id))->assertOk();
});

test('can update post', function() {
    $this->authenticate();
    $post = Post::factory()->create();
    $this->patch(route('app.posts.update', $post->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.posts.index'));

    $this->assertDatabaseHas('posts', ['name' => 'Joe Smith']);
});

test('can delete post', function() {
    $this->authenticate();
    $post = Post::factory()->create();
    $this->delete(route('app.posts.delete', $post->id))->assertRedirect(route('app.posts.index'));

    $this->assertDatabaseCount('posts', 0);
});