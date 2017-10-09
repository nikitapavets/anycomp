<?php

namespace App\Console\Commands\Elastic;

use Elasticsearch\ClientBuilder;
use App\Models\Client;
use Illuminate\Console\Command;

class IndexClientsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:clients';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all clients to elasticsearch';

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
        $this->removeClientsIndexes();
        $this->indexClients();
    }

    private function removeClientsIndexes()
    {
        $this->info('Remove all clients indexes...');
        exec('curl -X \'DELETE\' localhost:9200/clients');
        $this->info("Done!");
    }

    private function indexClients()
    {
        $clients = Client::all();
        $es = ClientBuilder::create()->build();

        $this->info('Indexing all clients. Might take a while...');
        $bar = $this->output->createProgressBar(count($clients));
        foreach ($clients as $client) {
            $es->index([
                'index' => $client->getSearchIndex(),
                'type' => $client->getSearchType(),
                'id' => $client->id,
                'body' => $client->toSearchArray()
            ]);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\nDone!");
    }
}
