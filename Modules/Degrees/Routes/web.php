<?php

use Modules\Degrees\Http\Controllers\DegreesController;

Route::middleware('auth')->prefix('admin/degrees')->group(function() {
    Route::get('/', [DegreesController::class, 'index'])->name('app.degrees.index');
    Route::get('create', [DegreesController::class, 'create'])->name('app.degrees.create');
    Route::post('create', [DegreesController::class, 'store'])->name('app.degrees.store');
    Route::get('edit/{id}', [DegreesController::class, 'edit'])->name('app.degrees.edit');
    Route::patch('edit/{id}', [DegreesController::class, 'update'])->name('app.degrees.update');
    Route::delete('delete/{id}', [DegreesController::class, 'destroy'])->name('app.degrees.delete');
    Route::delete('degrees/destroy', [DegreesController::class,'massDestroy'])->name('degrees.massDestroy');
});
