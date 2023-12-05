<?php

use Modules\FsiMenus\Http\Controllers\FsiMenusController;

Route::middleware('auth')->prefix('admin/fsi_menus')->group(function() {
    Route::get('/', [FsiMenusController::class, 'index'])->name('app.fsi_menus.index');
    Route::get('create', [FsiMenusController::class, 'create'])->name('app.fsi_menus.create');
    Route::post('create', [FsiMenusController::class, 'store'])->name('app.fsi_menus.store');
    Route::get('edit/{id}', [FsiMenusController::class, 'edit'])->name('app.fsi_menus.edit');
    Route::patch('edit/{id}', [FsiMenusController::class, 'update'])->name('app.fsi_menus.update');
    Route::delete('delete/{id}', [FsiMenusController::class, 'destroy'])->name('app.fsi_menus.delete');
});
