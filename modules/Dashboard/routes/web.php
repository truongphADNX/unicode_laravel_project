<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
    });
