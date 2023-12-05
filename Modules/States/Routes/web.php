<?php

use Modules\States\Http\Controllers\StatesController;

Route::middleware('auth')->prefix('admin/states')->group(function() {
    Route::get('/', [StatesController::class, 'index'])->name('app.states.index');
    Route::get('create', [StatesController::class, 'create'])->name('app.states.create');
    Route::post('create', [StatesController::class, 'store'])->name('app.states.store');
    Route::get('edit/{id}', [StatesController::class, 'edit'])->name('app.states.edit');
    Route::patch('edit/{id}', [StatesController::class, 'update'])->name('app.states.update');
    Route::delete('delete/{id}', [StatesController::class, 'destroy'])->name('app.states.delete');
    Route::delete('states/destroy', [StatesController::class,'massDestroy'])->name('states.massDestroy');
});
