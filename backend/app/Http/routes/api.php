<?php

Route::get('notebooks/search', ['uses' => 'NotebookController@search']);
Route::resource('notebooks', 'NotebookController');
Route::get('tvs/search', ['uses' => 'TvController@search']);
Route::resource('tvs', 'TvController');
Route::get('catalog/popular', ['uses' => 'CatalogController@popular']);
Route::resource('users', 'UserController');
