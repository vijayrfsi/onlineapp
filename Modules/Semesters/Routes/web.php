<?php

use Modules\Semesters\Http\Controllers\SemestersController;

Route::middleware('auth')->prefix('admin/semesters')->group(function() {
    Route::get('/', [SemestersController::class, 'index'])->name('app.semesters.index');
    Route::get('create', [SemestersController::class, 'create'])->name('app.semesters.create');
    Route::post('create', [SemestersController::class, 'store'])->name('app.semesters.store');
    Route::get('edit/{id}', [SemestersController::class, 'edit'])->name('app.semesters.edit');
    Route::patch('edit/{id}', [SemestersController::class, 'update'])->name('app.semesters.update');
    Route::delete('delete/{id}', [SemestersController::class, 'destroy'])->name('app.semesters.delete');
    Route::delete('semesters/destroy', [SemestersController::class,'massDestroy'])->name('semesters.massDestroy');
});
