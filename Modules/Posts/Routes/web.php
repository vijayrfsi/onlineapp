<?php

use Modules\Posts\Http\Controllers\PostsController;

Route::middleware('auth')->prefix('app/posts')->group(function() {
    Route::get('/', [PostsController::class, 'index'])->name('app.posts.index');
    Route::get('create', [PostsController::class, 'create'])->name('app.posts.create');
    Route::post('create', [PostsController::class, 'store'])->name('app.posts.store');
    Route::get('edit/{id}', [PostsController::class, 'edit'])->name('app.posts.edit');
    Route::patch('edit/{id}', [PostsController::class, 'update'])->name('app.posts.update');
    Route::delete('delete/{id}', [PostsController::class, 'destroy'])->name('app.posts.delete');
});
