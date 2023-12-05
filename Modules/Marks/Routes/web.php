<?php

use Modules\Marks\Http\Controllers\MarksController;

Route::middleware('auth')->prefix('admin/marks')->group(function() {
    Route::get('/', [MarksController::class, 'index'])->name('app.marks.index');
    Route::get('create', [MarksController::class, 'create'])->name('app.marks.create');
    Route::post('create', [MarksController::class, 'store'])->name('app.marks.store');
    Route::get('edit/{id}', [MarksController::class, 'edit'])->name('app.marks.edit');
    Route::patch('edit/{id}', [MarksController::class, 'update'])->name('app.marks.update');
    Route::delete('delete/{id}', [MarksController::class, 'destroy'])->name('app.marks.delete');
    Route::delete('marks/destroy', [MarksController::class,'massDestroy'])->name('marks.massDestroy');
});
