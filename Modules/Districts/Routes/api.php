<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/districts', function (Request $request) {
    return $request->user();
});