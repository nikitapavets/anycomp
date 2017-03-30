<?php

Route::pattern('id', '[0-9]+');

Route::get('/', ['as' => 'index', 'uses' => 'MainController@index']);

Route::group(
    ['prefix' => 'dev'],
    function () {

        Route::get('/svg', ['as' => 'dev.svg', 'uses' => 'DeveloperController@svg']);

    }
);

Route::group(
    ['prefix' => 'upload'],
    function () {

        Route::post('/files', ['as' => 'upload.files', 'uses' => 'UploadController@files']);

    }
);

Route::get('/login', ['as' => 'admin.login', 'uses' => 'AdminController@login']);
Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'AdminController@logout']);
Route::post('/check', ['as' => 'admin.check', 'uses' => 'AdminController@check']);


Route::group(
    ['prefix' => 'admin'],
    function () {
        Route::group(
            ['middleware' => 'admin'],
            function () {

                Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

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

                    }
                );

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
                Route::group(
                    ['prefix' => 'menu_constructor'],
                    function () {

                        Route::group(
                            ['prefix' => 'catalog_menu'],
                            function () {

                                Route::get(
                                    '/',
                                    [
                                        'as' => 'admin.menu_constructor.catalog_menu',
                                        'uses' => 'MenuConstructorController@catalogMenu',
                                    ]
                                );
                                Route::post(
                                    '/delete',
                                    [
                                        'as' => 'admin.menu_constructor.catalog_menu.delete',
                                        'uses' => 'MenuConstructorController@catalogMenuDelete',
                                    ]
                                );
                                Route::get(
                                    '/create',
                                    [
                                        'as' => 'admin.menu_constructor.catalog_menu.create',
                                        'uses' => 'MenuConstructorController@catalogMenuCreate',
                                    ]
                                );
                                Route::post(
                                    '/create/save',
                                    [
                                        'as' => 'admin.menu_constructor.catalog_menu.create.save',
                                        'uses' => 'MenuConstructorController@catalogMenuCreateSave',
                                    ]
                                );
                                Route::get(
                                    '/update',
                                    [
                                        'as' => 'admin.menu_constructor.catalog_menu.update',
                                        'uses' => 'MenuConstructorController@catalogMenuUpdate',
                                    ]
                                );
                                Route::post(
                                    '/update/save',
                                    [
                                        'as' => 'admin.menu_constructor.catalog_menu.update.save',
                                        'uses' => 'MenuConstructorController@catalogMenuUpdateSave',
                                    ]
                                );

                                Route::group(
                                    ['prefix' => '{catalog_menu_id}/sub_menu'],
                                    function () {

                                        Route::get(
                                            '/',
                                            [
                                                'as' => 'admin.menu_constructor.catalog_menu.sub_menu',
                                                'uses' => 'MenuConstructorController@catalogSubMenu',
                                            ]
                                        );
                                        Route::post(
                                            '/delete',
                                            [
                                                'as' => 'admin.menu_constructor.catalog_menu.sub_menu.delete',
                                                'uses' => 'MenuConstructorController@catalogSubMenuDelete',
                                            ]
                                        );
                                        Route::get(
                                            '/create',
                                            [
                                                'as' => 'admin.menu_constructor.catalog_menu.sub_menu.create',
                                                'uses' => 'MenuConstructorController@catalogSubMenuCreate',
                                            ]
                                        );
                                        Route::post(
                                            '/create/save',
                                            [
                                                'as' => 'admin.menu_constructor.catalog_menu.sub_menu.create.save',
                                                'uses' => 'MenuConstructorController@catalogSubMenuCreateSave',
                                            ]
                                        );
                                        Route::get(
                                            '/update',
                                            [
                                                'as' => 'admin.menu_constructor.catalog_menu.sub_menu.update',
                                                'uses' => 'MenuConstructorController@catalogSubMenuUpdate',
                                            ]
                                        );
                                        Route::post(
                                            '/update/save',
                                            [
                                                'as' => 'admin.menu_constructor.catalog_menu.sub_menu.update.save',
                                                'uses' => 'MenuConstructorController@catalogSubMenuUpdateSave',
                                            ]
                                        );

                                        Route::group(
                                            ['prefix' => '{sub_menu_id}/addition_menu'],
                                            function () {

                                                Route::get(
                                                    '/',
                                                    [
                                                        'as' => 'admin.menu_constructor.catalog_menu.sub_menu.addition_menu',
                                                        'uses' => 'MenuConstructorController@catalogAdditionMenu',
                                                    ]
                                                );
                                                Route::post(
                                                    '/delete',
                                                    [
                                                        'as' => 'admin.menu_constructor.catalog_menu.sub_menu.addition_menu.delete',
                                                        'uses' => 'MenuConstructorController@catalogAdditionMenuDelete',
                                                    ]
                                                );
                                                Route::get(
                                                    '/create',
                                                    [
                                                        'as' => 'admin.menu_constructor.catalog_menu.sub_menu.addition_menu.create',
                                                        'uses' => 'MenuConstructorController@catalogAdditionMenuCreate',
                                                    ]
                                                );
                                                Route::post(
                                                    '/create/save',
                                                    [
                                                        'as' => 'admin.menu_constructor.catalog_menu.sub_menu.addition_menu.create.save',
                                                        'uses' => 'MenuConstructorController@catalogAdditionMenuCreateSave',
                                                    ]
                                                );
                                                Route::get(
                                                    '/update',
                                                    [
                                                        'as' => 'admin.menu_constructor.catalog_menu.sub_menu.addition_menu.update',
                                                        'uses' => 'MenuConstructorController@catalogAdditionMenuUpdate',
                                                    ]
                                                );
                                                Route::post(
                                                    '/update/save',
                                                    [
                                                        'as' => 'admin.menu_constructor.catalog_menu.sub_menu.addition_menu.update.save',
                                                        'uses' => 'MenuConstructorController@catalogAdditionMenuUpdateSave',
                                                    ]
                                                );

                                            }
                                        );

                                    }
                                );

                            }
                        );

                    }
                );

                Route::group(
                    ['prefix' => 'orders'],
                    function () {

                        Route::group(
                            ['prefix' => 'baskets'],
                            function () {

                                Route::get(
                                    '/list',
                                    [
                                        'as' => 'admin.orders.baskets.list',
                                        'uses' => 'BasketController@show',
                                    ]
                                );

                            }
                        );

                    }
                );

            }
        );

    }
);
