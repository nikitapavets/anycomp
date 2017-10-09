<?php

Route::post('authenticate', 'AuthController@authenticate')
    ->name('authenticate');
Route::post('register', 'AuthController@register')
    ->name('register');

Route::get('day-offer', 'CatalogController@dayOffer')
    ->name('day-offer');

Route::resource('notebooks', 'NotebookController');

Route::get('notebooks/search', ['uses' => 'NotebookController@search']);

Route::get('clients/search', 'ClientController@search');

Route::get('tvs/search', ['uses' => 'TvController@search']);
Route::resource('tvs', 'TvController');
Route::get('catalog/popular', ['uses' => 'CatalogController@popular']);
Route::post('users/auth', ['uses' => 'UserController@post']);
Route::post('order/client', ['uses' => 'OrderController@client']);
Route::post('order/products', ['uses' => 'OrderController@products']);

Route::post('repairs/updateStatus', 'RepairController@updateStatus');
Route::resource('repairs', 'RepairController');

Route::get('statistics/repairs', ['uses' => 'StatisticsController@repairs']);

Route::resource('repair_description', 'RepairDescriptionController');

Route::get('spares/search', 'SpareController@search');

Route::delete('spares/bind-to-repair', 'SpareController@unbindFromRepair');
Route::post('spares/bind-to-repair', 'SpareController@bindToRepair');
