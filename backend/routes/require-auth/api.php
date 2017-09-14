<?php

Route::resource('users', 'UserController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy']
]);
