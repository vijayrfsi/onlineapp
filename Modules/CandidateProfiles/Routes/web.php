<?php

use Modules\CandidateProfiles\Http\Controllers\CandidateProfilesController;

Route::middleware('auth')->prefix('admin/candidate_profiles')->group(function() {
    Route::get('/', [CandidateProfilesController::class, 'index'])->name('app.candidate_profiles.index');
    Route::get('create', [CandidateProfilesController::class, 'create'])->name('app.candidate_profiles.create');
    Route::post('create', [CandidateProfilesController::class, 'store'])->name('app.candidate_profiles.store');
    Route::get('edit/{id}', [CandidateProfilesController::class, 'edit'])->name('app.candidate_profiles.edit');
    Route::patch('edit/{id}', [CandidateProfilesController::class, 'update'])->name('app.candidate_profiles.update');
    Route::delete('delete/{id}', [CandidateProfilesController::class, 'destroy'])->name('app.candidate_profiles.delete');
    Route::delete('candidate_profiles/destroy', [CandidateProfilesController::class,'massDestroy'])->name('candidate_profiles.massDestroy');
});
