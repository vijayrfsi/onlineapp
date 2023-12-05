<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/marks', function (Request $request) {
    return $request->user();
});