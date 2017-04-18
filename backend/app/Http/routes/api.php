<?php

Route::get('notebooks/search', ['uses' => 'NotebookController@search']);
Route::resource('notebooks', 'NotebookController');
Route::get('tvs/search', ['uses' => 'TvController@search']);
Route::resource('tvs', 'TvController');
Route::get('catalog/popular', ['uses' => 'CatalogController@popular']);
Route::post('users/auth', ['uses' => 'UserController@post']);
Route::resource('users', 'UserController');
Route::post('order/client', ['uses' => 'OrderController@client']);
Route::post('order/products', ['uses' => 'OrderController@products']);
