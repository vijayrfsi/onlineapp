<?php

use Modules\Students\Http\Controllers\StudentsController;

Route::middleware('auth')->prefix('admin/students')->group(function() {
    Route::get('/', [StudentsController::class, 'index'])->name('app.students.index');
    Route::get('create', [StudentsController::class, 'create'])->name('app.students.create');
    Route::post('create', [StudentsController::class, 'store'])->name('app.students.store');
    Route::get('edit/{id}', [StudentsController::class, 'edit'])->name('app.students.edit');
    Route::patch('edit/{id}', [StudentsController::class, 'update'])->name('app.students.update');
    Route::delete('delete/{id}', [StudentsController::class, 'destroy'])->name('app.students.delete');
    Route::delete('students/destroy', [StudentsController::class,'massDestroy'])->name('students.massDestroy');
});
