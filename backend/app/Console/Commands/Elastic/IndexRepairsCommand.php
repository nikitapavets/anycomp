<?php

namespace App\Console\Commands\Elastic;

use App\Models\Repair;
use Elasticsearch\ClientBuilder;
use App\Models\Client;
use Illuminate\Console\Command;

class IndexRepairsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:repairs';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all repairs to elasticsearch';

    /**
     * IndexClientsCommand constructor.
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
        $this->removeIndexRepairs();
        $this->indexRepairs();
    }

    private function removeIndexRepairs()
    {
        $this->info('Remove all repairs indexes...');
        exec('curl -X \'DELETE\' localhost:9200/repairs');
        $this->info("Done!");
    }

    private function indexRepairs()
    {
        $repairs = Repair::all();
        $es = ClientBuilder::create()->build();

        $this->info('Indexing all repairs. Might take a while...');
        $bar = $this->output->createProgressBar(count($repairs));
        foreach ($repairs as $repair) {
            $es->index([
                'index' => $repair->getSearchIndex(),
                'type' => $repair->getSearchType(),
                'id' => $repair->id,
                'body' => $repair->toSearchArray()
            ]);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\nDone!");
    }
}
