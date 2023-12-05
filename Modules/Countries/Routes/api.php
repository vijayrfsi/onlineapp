<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/countries', function (Request $request) {
    return $request->user();
});