<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('web')
->namespace('Modules\Course\src\Http\Controllers')->group(function () {
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/','CourseController@index')->name('index');
        Route::get('/data', 'CourseController@data')->name('data');
        Route::get('/create','CourseController@create')->name('create');
        Route::post('/create','CourseController@store')->name('store');
        Route::get('/edit/{course}','CourseController@edit')->name('edit');
        Route::put('/update/{course}','CourseController@update')->name('update');
        Route::delete('/delete/{course}','CourseController@delete')->name('delete');
    });
});

