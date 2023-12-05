<?php

use Modules\Makes\Http\Controllers\MakesController;

Route::middleware('auth')->prefix('admin/makes')->group(function() {
    Route::get('/', [MakesController::class, 'index'])->name('app.makes.index');
    Route::get('create', [MakesController::class, 'create'])->name('app.makes.create');
    Route::post('create', [MakesController::class, 'store'])->name('app.makes.store');
    Route::get('edit/{id}', [MakesController::class, 'edit'])->name('app.makes.edit');
    Route::patch('edit/{id}', [MakesController::class, 'update'])->name('app.makes.update');
    Route::delete('delete/{id}', [MakesController::class, 'destroy'])->name('app.makes.delete');
    Route::delete('makes/destroy', [MakesController::class,'massDestroy'])->name('makes.massDestroy');
});
