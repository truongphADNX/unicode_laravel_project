<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Modules\Dashboard\src\Http\Controllers')
->name('admin.')->group(function () {
    Route::get('/','DashboardController@index')->name('dashboard');
});
