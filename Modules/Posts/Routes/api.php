<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/posts', function (Request $request) {
    return $request->user();
});