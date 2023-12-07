<?php
Route::get('/', function () { return redirect('/admin/home'); });

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('abilities/destroy', 'AbilitiesController@massDestroy')->name('abilities.massDestroy');
    Route::resource('abilities', 'AbilitiesController');
    Route::resource('fsi_tables', 'FsiTablesController');
    Route::post('fsi_tables/destroy', 'FsiTablesController@massDestroy')->name('fsi_tables.massDestroy');
    Route::resource('fsi_table_fields', 'FsiTableFieldsController');
    Route::post('fsi_table_fields/destroy', 'FsiTableFieldsController@massDestroy')->name('fsi_table_fields.massDestroy');
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
});
