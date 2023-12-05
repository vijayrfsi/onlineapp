<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/brands', function (Request $request) {
    return $request->user();
});