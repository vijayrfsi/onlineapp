<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/fsi_menus', function (Request $request) {
    return $request->user();
});