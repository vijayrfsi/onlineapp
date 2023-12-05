<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/subjects', function (Request $request) {
    return $request->user();
});