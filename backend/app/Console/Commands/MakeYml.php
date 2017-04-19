<?php

namespace App\Console\Commands;

use App\Models\Catalog\Notebook;
use App\Models\Catalog\Tv;
use App\Repositories\NotebookRepository;
use App\Repositories\TvRepository;
use Illuminate\Console\Command;
use Bukashk0zzz\YmlGenerator\Model\Offer\OfferCustom;
use Bukashk0zzz\YmlGenerator\Model\Category;
use Bukashk0zzz\YmlGenerator\Model\Currency;
use Bukashk0zzz\YmlGenerator\Model\ShopInfo;
use Bukashk0zzz\YmlGenerator\Settings;
use Bukashk0zzz\YmlGenerator\Generator;

class MakeYml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:yml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make yml file in /public directory';

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
        $settings = (new Settings())
            ->setOutputFile('public/yml.xml')
        ;

        $shopInfo = (new ShopInfo())
            ->setName('AnyComp.by')
            ->setCompany('AnyComp')
            ->setUrl('http://www.anycomp.by/')
        ;

        $currencies = [];
        $currencies[] = (new Currency())
            ->setId('BYN')
            ->setRate(1)
        ;

        $categories = [];
        $categories[] = (new Category())
            ->setId(1)
            ->setName('Ноутбуки')
        ;
        $categories[] = (new Category())
            ->setId(2)
            ->setName('Телевизоры')
        ;

        $offerNumber = 1;
        $offers = [];
        foreach (NotebookRepository::getNotebooks() as $notebook) {
            $offers[] = (new OfferCustom())
                ->setCategoryId(1)
                ->setId($offerNumber++)
                ->setAvailable(true)
                ->setUrl($notebook->getLink())
                ->setPrice($notebook->getPrice())
                ->setCurrencyId('BYN')
                ->setDelivery(true)
                ->setManufacturerWarranty(true)
                ->setTypePrefix(Notebook::PRODUCT_TITLE)
                ->setVendor($notebook->getBrand()->getName())
                ->setModel($notebook->getModel())
                ->setDescription($notebook->getDescription())
            ;
        }
        $this->info('Made notebooks yml');
        foreach (TvRepository::getTvs() as $tv) {
            $offers[] = (new OfferCustom())
                ->setCategoryId(2)
                ->setId($offerNumber++)
                ->setAvailable(true)
                ->setUrl($tv->getLink())
                ->setPrice($tv->getPrice())
                ->setCurrencyId('BYN')
                ->setDelivery(true)
                ->setManufacturerWarranty(true)
                ->setTypePrefix(Tv::PRODUCT_TITLE)
                ->setVendor($tv->getBrand()->getName())
                ->setModel($tv->getModel())
                ->setDescription($tv->getDescription())
            ;
        }
        $this->info('Made tvs yml');

        (new Generator($settings))->generate(
            $shopInfo,
            $currencies,
            $categories,
            $offers
        );
        $this->info('Done');
    }
}
