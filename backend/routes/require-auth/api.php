<?php

Route::resource('users', 'UserController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);

Route::resource('notebooks', 'NotebookController');
