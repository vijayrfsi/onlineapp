<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/states', function (Request $request) {
    return $request->user();
});