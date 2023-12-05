<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/blogs', function (Request $request) {
    return $request->user();
});