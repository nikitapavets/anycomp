<?php

namespace App\Console\Commands;

use App\Repositories\NotebookRepository;
use App\Repositories\TvRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class MakeSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make sitemap file in /public directory';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap_main = App::make("sitemap");
        $sitemap_main->add(URL::to('/'), null, '1.0', 'daily');
        $sitemap_main->add(URL::to('/notebooks'), null, '0.9', 'weekly');
        $sitemap_main->add(URL::to('/tvs'), null, '0.9', 'weekly');
        $sitemap_main->add(URL::to('/user'), null, '0.5', 'weekly');
        $sitemap_main->add(URL::to('/registration'), null, '0.5', 'weekly');
        $sitemap_main->store('xml', 'sitemap-main');
        $this->info('Made sitemap-main');

        $sitemap_tvs = App::make("sitemap");
        foreach (TvRepository::getTvs() as $tv) {
            $sitemap_tvs->add(URL::to($tv->getLink()), $tv->getUpdatedAt(true), '0.9', 'weekly');
        }
        $sitemap_tvs->store('xml', 'sitemap-tvs');
        $this->info('Made sitemap-tvs');

        $sitemap_notebooks = App::make("sitemap");
        foreach (NotebookRepository::getNotebooks() as $notebook) {
            $sitemap_notebooks->add(URL::to($notebook->getLink()), $notebook->getUpdatedAt(true), '0.9', 'weekly');
        }
        $sitemap_notebooks->store('xml', 'sitemap-notebooks');
        $this->info('Made sitemap-notebooks');

        $sitemap = App::make("sitemap");
        $sitemap->addSitemap(URL::to('sitemap-main'));
        $sitemap->addSitemap(URL::to('sitemap-tvs'));
        $sitemap->addSitemap(URL::to('sitemap-notebooks'));
        $sitemap->store('sitemapindex', 'sitemap');
        $this->info('Made sitemap');

        $this->info('Done');
    }
}
