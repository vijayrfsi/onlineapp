<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/semesters', function (Request $request) {
    return $request->user();
});