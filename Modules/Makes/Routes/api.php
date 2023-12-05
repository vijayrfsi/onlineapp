<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/makes', function (Request $request) {
    return $request->user();
});