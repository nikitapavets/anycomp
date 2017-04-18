<?php

Route::pattern('id', '[0-9]+');

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

/**
 * WEB
 */

Route::get(
    'sitemap',
    function () {
        $sitemap = App::make("sitemap");
        $sitemap->addSitemap(URL::to('sitemap-main'));
        $sitemap->addSitemap(URL::to('sitemap-tvs'));
        $sitemap->addSitemap(URL::to('sitemap-notebooks'));

        return $sitemap->render('sitemapindex');
    }
);

Route::get(
    'sitemap-main',
    function () {
        $sitemap_main = App::make("sitemap");
        $sitemap_main->add(URL::to('/'), null, '1.0', 'daily');
        $sitemap_main->add(URL::to('/notebooks'), null, '0.9', 'weekly');
        $sitemap_main->add(URL::to('/tvs'), null, '0.9', 'weekly');
        $sitemap_main->add(URL::to('/user'), null, '0.5', 'weekly');
        $sitemap_main->add(URL::to('/registration'), null, '0.5', 'weekly');

        return $sitemap_main->render('xml');
    }
);

Route::get(
    'sitemap-notebooks',
    function () {
        $sitemap_notebooks = App::make("sitemap");
        foreach (\App\Repositories\NotebookRepository::getNotebooks() as $notebook) {
            $sitemap_notebooks->add(URL::to($notebook->getLink()), $notebook->getUpdatedAt(true), '0.9', 'weekly');
        }

        return $sitemap_notebooks->render('xml');
    }
);

Route::get(
    'sitemap-tvs',
    function () {
        $sitemap_tvs = App::make("sitemap");
        foreach (\App\Repositories\TvRepository::getTvs() as $tv) {
            $sitemap_tvs->add(URL::to($tv->getLink()), $tv->getUpdatedAt(true), '0.9', 'weekly');
        }

        return $sitemap_tvs->render('xml');
    }
);

Route::get('{slug}', ['as' => 'index', 'uses' => 'MainController@index'])
    ->where('slug', '([A-z\d-\/_.]+)?');