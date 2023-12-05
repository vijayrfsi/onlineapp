<?php

use Modules\Classes\Http\Controllers\ClassesController;

Route::middleware('auth')->prefix('admin/classes')->group(function() {
    Route::get('/', [ClassesController::class, 'index'])->name('app.classes.index');
    Route::get('create', [ClassesController::class, 'create'])->name('app.classes.create');
    Route::post('create', [ClassesController::class, 'store'])->name('app.classes.store');
    Route::get('edit/{id}', [ClassesController::class, 'edit'])->name('app.classes.edit');
    Route::patch('edit/{id}', [ClassesController::class, 'update'])->name('app.classes.update');
    Route::delete('delete/{id}', [ClassesController::class, 'destroy'])->name('app.classes.delete');
    Route::delete('classes/destroy', [ClassesController::class,'massDestroy'])->name('classes.massDestroy');
});
