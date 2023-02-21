<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('web')
->namespace('Modules\Dog\src\Http\Controllers')->group(function () {
    Route::prefix('dogs')->name('dogs.')->group(function () {
        Route::get('/','DogController@index')->name('index');
        Route::get('/data', 'DogController@data')->name('data');
        Route::get('/create','DogController@create')->name('create');
        Route::post('/create','DogController@store')->name('store');
        Route::get('/edit/{dog}','DogController@edit')->name('edit');
        Route::put('/update/{dog}','DogController@update')->name('update');
        Route::delete('/delete/{dog}','DogController@delete')->name('delete');
    });
});

