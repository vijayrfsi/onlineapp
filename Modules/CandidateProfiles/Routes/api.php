<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/candidate_profiles', function (Request $request) {
    return $request->user();
});