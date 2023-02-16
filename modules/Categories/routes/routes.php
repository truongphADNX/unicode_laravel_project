<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('web')
->namespace('Modules\Categories\src\Http\Controllers')->group(function () {
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/','CategoriesController@index')->name('index');
        Route::get('/data', 'CategoriesController@data')->name('data');
        Route::get('/create','CategoriesController@create')->name('create');
        Route::post('/create','CategoriesController@store')->name('store');
        Route::get('/edit/{categories}','CategoriesController@edit')->name('edit');
        Route::put('/update/{categories}','CategoriesController@update')->name('update');
        Route::delete('/delete/{categories}','CategoriesController@delete')->name('delete');
    });
});
