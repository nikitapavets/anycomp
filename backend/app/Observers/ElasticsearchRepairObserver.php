<?php

namespace App\Observers;

use Elasticsearch\Client;
use App\Models\Repair;

class ElasticsearchRepairObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(Repair $repair)
    {
        $this->elasticsearch->index([
            'index' => $repair->getSearchIndex(),
            'type' => $repair->getSearchType(),
            'id' => $repair->id,
            'body' => $repair->toSearchArray()
        ]);
    }

    public function updated(Repair $repair)
    {
        $this->elasticsearch->index([
            'index' => $repair->getSearchIndex(),
            'type' => $repair->getSearchType(),
            'id' => $repair->id,
            'body' => $repair->toSearchArray()
        ]);
    }

    public function deleted(Repair $repair)
    {
        $this->elasticsearch->index([
            'index' => $repair->getSearchIndex(),
            'type' => $repair->getSearchType(),
            'id' => $repair->id,
            'body' => []
        ]);
    }
}
