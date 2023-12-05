<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/degrees', function (Request $request) {
    return $request->user();
});