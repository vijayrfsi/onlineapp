<?php

use Modules\Countries\Http\Controllers\CountriesController;

Route::middleware('auth')->prefix('admin/countries')->group(function() {
    Route::get('/', [CountriesController::class, 'index'])->name('app.countries.index');
    Route::get('create', [CountriesController::class, 'create'])->name('app.countries.create');
    Route::post('create', [CountriesController::class, 'store'])->name('app.countries.store');
    Route::get('edit/{id}', [CountriesController::class, 'edit'])->name('app.countries.edit');
    Route::patch('edit/{id}', [CountriesController::class, 'update'])->name('app.countries.update');
    Route::delete('delete/{id}', [CountriesController::class, 'destroy'])->name('app.countries.delete');
    Route::delete('countries/destroy', [CountriesController::class,'massDestroy'])->name('countries.massDestroy');
});
