<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/fsi_menu_items', function (Request $request) {
    return $request->user();
});