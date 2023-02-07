<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('web')
->namespace('Modules\User\src\Http\Controllers')->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/','UserController@index')->name('index');
        Route::get('/data', 'UserController@data')->name('data');
        Route::get('/create','UserController@create')->name('create');
        Route::post('/create','UserController@store')->name('store');
    });
});
