<?php

use Modules\Cities\Http\Controllers\CitiesController;

Route::middleware('auth')->prefix('admin/cities')->group(function() {
    Route::get('/', [CitiesController::class, 'index'])->name('app.cities.index');
    Route::get('create', [CitiesController::class, 'create'])->name('app.cities.create');
    Route::post('create', [CitiesController::class, 'store'])->name('app.cities.store');
    Route::get('edit/{id}', [CitiesController::class, 'edit'])->name('app.cities.edit');
    Route::patch('edit/{id}', [CitiesController::class, 'update'])->name('app.cities.update');
    Route::delete('delete/{id}', [CitiesController::class, 'destroy'])->name('app.cities.delete');
    Route::delete('cities/destroy', [CitiesController::class,'massDestroy'])->name('cities.massDestroy');
});
