<?php

use Modules\FsiMenuItems\Http\Controllers\FsiMenuItemsController;

Route::middleware('auth')->prefix('admin/fsi_menu_items')->group(function() {
    Route::get('/', [FsiMenuItemsController::class, 'index'])->name('app.fsi_menu_items.index');
    Route::get('create', [FsiMenuItemsController::class, 'create'])->name('app.fsi_menu_items.create');
    Route::post('create', [FsiMenuItemsController::class, 'store'])->name('app.fsi_menu_items.store');
    Route::get('edit/{id}', [FsiMenuItemsController::class, 'edit'])->name('app.fsi_menu_items.edit');
    Route::patch('edit/{id}', [FsiMenuItemsController::class, 'update'])->name('app.fsi_menu_items.update');
    Route::delete('delete/{id}', [FsiMenuItemsController::class, 'destroy'])->name('app.fsi_menu_items.delete');
    Route::delete('fsi_menu_items/destroy', [FsiMenuItemsController::class,'massDestroy'])->name('fsi_menu_items.massDestroy');
});
