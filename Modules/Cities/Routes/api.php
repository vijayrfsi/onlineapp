<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/cities', function (Request $request) {
    return $request->user();
});