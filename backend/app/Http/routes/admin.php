<?php

Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

Route::group(['prefix' => 'orders', 'namespace' => 'Orders'], function () {
    Route::resource('site', 'SiteController');
});

Route::group(
    ['prefix' => 'catalog'],
    function () {

        Route::group(
            ['prefix' => 'tv'],
            function () {

                Route::get(
                    '/list',
                    ['as' => 'admin.catalog.tv.list', 'uses' => 'AdminCatalogController@tvList']
                );
                Route::get(
                    '/create',
                    [
                        'as' => 'admin.catalog.tv.create',
                        'uses' => 'AdminCatalogController@tvCreateUpdate',
                    ]
                );
                Route::get(
                    '/{tv_id}/update',
                    [
                        'as' => 'admin.catalog.tv.update',
                        'uses' => 'AdminCatalogController@tvCreateUpdate',
                    ]
                );
                Route::post(
                    '/save',
                    ['as' => 'admin.catalog.tv.save', 'uses' => 'AdminCatalogController@tvSave']
                );
                Route::post(
                    '/delete',
                    ['as' => 'admin.catalog.tv.delete', 'uses' => 'AdminCatalogController@tvDelete']
                );

            }
        );

        Route::group(
            ['prefix' => 'notebook'],
            function () {

                Route::get(
                    '/list',
                    [
                        'as' => 'admin.catalog.notebook.list',
                        'uses' => 'AdminCatalogController@notebookList',
                    ]
                );
                Route::get(
                    '/create',
                    [
                        'as' => 'admin.catalog.notebook.create',
                        'uses' => 'AdminCatalogController@notebookCreateUpdate',
                    ]
                );
                Route::get(
                    '/{notebook_id}/update',
                    [
                        'as' => 'admin.catalog.notebook.update',
                        'uses' => 'AdminCatalogController@notebookCreateUpdate',
                    ]
                );
                Route::post(
                    '/save',
                    [
                        'as' => 'admin.catalog.notebook.create.save',
                        'uses' => 'AdminCatalogController@notebookSave',
                    ]
                );
                Route::post(
                    '/delete',
                    [
                        'as' => 'admin.catalog.notebook.delete',
                        'uses' => 'AdminCatalogController@notebookDelete',
                    ]
                );

            }
        );

    }
);

Route::group(
    ['prefix' => 'repair'],
    function () {

        Route::get('/list', ['as' => 'admin.repair.list', 'uses' => 'RepairController@repairList']);
        Route::get(
            '/create',
            ['as' => 'admin.repair.create', 'uses' => 'RepairController@repairCreateUpdate']
        );
        Route::post(
            '/save',
            ['as' => 'admin.repair.create.save', 'uses' => 'RepairController@repairSave']
        );
        Route::post(
            '/delete',
            ['as' => 'admin.repair.delete', 'uses' => 'RepairController@repairDelete']
        );
        Route::get(
            '/{repair_id}/update',
            ['as' => 'admin.repair.update', 'uses' => 'RepairController@repairCreateUpdate']
        );
        Route::get(
            '/print_doc',
            ['as' => 'admin.repair.print_doc', 'uses' => 'RepairController@printDoc']
        );
        Route::post(
            '/update_status',
            ['as' => 'admin.repair.update_status', 'uses' => 'RepairController@updateStatus']
        );
        Route::get(
            '/statistics',
            ['as' => 'admin.repair.statistics', 'uses' => 'RepairController@statistics']
        );
        Route::get(
            '/statistics/print',
            ['as' => 'admin.repair.statistics.print', 'uses' => 'RepairController@statisticsPrint']
        );
        Route::get(
            '/choose_client',
            ['as' => 'admin.repair.choose_client', 'uses' => 'RepairController@chooseClient']
        );

    }
);

Route::resource('repair', 'RepairController', ['only' => [
    'show'
]]);

Route::group(
    ['prefix' => 'clients'],
    function () {

        Route::group(
            ['prefix' => 'repair'],
            function () {

                Route::get(
                    '/',
                    ['as' => 'admin.clients.repair', 'uses' => 'ClientController@clientsRepair']
                );

            }
        );

        Route::group(
            ['prefix' => 'callback'],
            function () {

                Route::get(
                    '/',
                    ['as' => 'admin.clients.callback', 'uses' => 'ClientController@clientsCallback']
                );
                Route::get(
                    '/accept',
                    [
                        'as' => 'admin.clients.callback.accept',
                        'uses' => 'ClientController@clientsCallbackAccept',
                    ]
                );

            }
        );

        Route::group(
            ['prefix' => 'unique'],
            function () {

                Route::get(
                    '/',
                    ['as' => 'admin.clients.unique', 'uses' => 'ClientController@clientsUnique']
                );

            }
        );

    }
);
Route::group(
    ['prefix' => 'db/{db_class}'],
    function () {
        Route::get(
            '/',
            ['as' => 'admin.db', 'uses' => 'DatabaseController@db']
        );
        Route::post(
            '/remove',
            ['as' => 'admin.db.remove', 'uses' => 'DatabaseController@dbRemove']
        );
        Route::post(
            '/save',
            ['as' => 'admin.db.save', 'uses' => 'DatabaseController@dbSave']
        );
    }
);

Route::resource('deliveries', 'DeliveriesController');
Route::post('deliveries/delete', 'DeliveriesController@destroy');

Route::resource('spares', 'SpareController');
Route::post('deliveries/delete', 'SpareController@destroy');