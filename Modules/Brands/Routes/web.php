<?php

use Modules\Brands\Http\Controllers\BrandsController;

Route::middleware('auth')->prefix('admin/brands')->group(function() {
    Route::get('/', [BrandsController::class, 'index'])->name('app.brands.index');
    Route::get('create', [BrandsController::class, 'create'])->name('app.brands.create');
    Route::post('create', [BrandsController::class, 'store'])->name('app.brands.store');
    Route::get('edit/{id}', [BrandsController::class, 'edit'])->name('app.brands.edit');
    Route::patch('edit/{id}', [BrandsController::class, 'update'])->name('app.brands.update');
    Route::delete('delete/{id}', [BrandsController::class, 'destroy'])->name('app.brands.delete');
    Route::delete('brands/destroy', [BrandsController::class,'massDestroy'])->name('brands.massDestroy');
});
