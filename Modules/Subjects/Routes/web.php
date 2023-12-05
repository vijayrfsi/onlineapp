<?php

use Modules\Subjects\Http\Controllers\SubjectsController;

Route::middleware('auth')->prefix('admin/subjects')->group(function() {
    Route::get('/', [SubjectsController::class, 'index'])->name('app.subjects.index');
    Route::get('create', [SubjectsController::class, 'create'])->name('app.subjects.create');
    Route::post('create', [SubjectsController::class, 'store'])->name('app.subjects.store');
    Route::get('edit/{id}', [SubjectsController::class, 'edit'])->name('app.subjects.edit');
    Route::patch('edit/{id}', [SubjectsController::class, 'update'])->name('app.subjects.update');
    Route::delete('delete/{id}', [SubjectsController::class, 'destroy'])->name('app.subjects.delete');
    Route::delete('subjects/destroy', [SubjectsController::class,'massDestroy'])->name('subjects.massDestroy');
});
