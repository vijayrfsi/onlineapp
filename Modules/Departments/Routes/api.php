<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/departments', function (Request $request) {
    return $request->user();
});