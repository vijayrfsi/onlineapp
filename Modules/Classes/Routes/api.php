<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/classes', function (Request $request) {
    return $request->user();
});