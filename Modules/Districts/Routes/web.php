<?php

use Modules\Districts\Http\Controllers\DistrictsController;

Route::middleware('auth')->prefix('admin/districts')->group(function() {
    Route::get('/', [DistrictsController::class, 'index'])->name('app.districts.index');
    Route::get('create', [DistrictsController::class, 'create'])->name('app.districts.create');
    Route::post('create', [DistrictsController::class, 'store'])->name('app.districts.store');
    Route::get('edit/{id}', [DistrictsController::class, 'edit'])->name('app.districts.edit');
    Route::patch('edit/{id}', [DistrictsController::class, 'update'])->name('app.districts.update');
    Route::delete('delete/{id}', [DistrictsController::class, 'destroy'])->name('app.districts.delete');
    Route::delete('districts/destroy', [DistrictsController::class,'massDestroy'])->name('districts.massDestroy');
});
