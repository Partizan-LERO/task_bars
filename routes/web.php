<?php
Auth::routes();

Route::get('/', 'PostsController@index')->name('index');
Route::get('post/{id}', 'PostsController@getPost')->name('post');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('create', 'PostsController@create')->name('create');
    Route::get('update/{id}', 'PostsController@update')->name('update');
    Route::get('delete/{id}', 'PostsController@delete')->name('delete');
    Route::post('store', 'PostsController@store')->name('store');
    Route::post('edit/{id}', 'PostsController@edit')->name('edit');
    Route::get('/tinymce_example', function () {
        return view('mceImageUpload::example');
    });
});