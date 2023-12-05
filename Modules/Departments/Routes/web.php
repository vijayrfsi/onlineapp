<?php

use Modules\Departments\Http\Controllers\DepartmentsController;

Route::middleware('auth')->prefix('admin/departments')->group(function() {
    Route::get('/', [DepartmentsController::class, 'index'])->name('app.departments.index');
    Route::get('create', [DepartmentsController::class, 'create'])->name('app.departments.create');
    Route::post('create', [DepartmentsController::class, 'store'])->name('app.departments.store');
    Route::get('edit/{id}', [DepartmentsController::class, 'edit'])->name('app.departments.edit');
    Route::patch('edit/{id}', [DepartmentsController::class, 'update'])->name('app.departments.update');
    Route::delete('delete/{id}', [DepartmentsController::class, 'destroy'])->name('app.departments.delete');
    Route::delete('departments/destroy', [DepartmentsController::class,'massDestroy'])->name('departments.massDestroy');
});
