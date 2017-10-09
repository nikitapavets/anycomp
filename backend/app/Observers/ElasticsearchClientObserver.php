<?php

namespace App\Observers;

use Elasticsearch\Client;
use App\Models\Client as User;

class ElasticsearchClientObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(User $user)
    {
        $this->elasticsearch->index([
            'index' => $user->getSearchIndex(),
            'type' => $user->getSearchType(),
            'id' => $user->id,
            'body' => $user->toSearchArray()
        ]);
    }

    public function updated(User $user)
    {
        $this->elasticsearch->index([
            'index' => $user->getSearchIndex(),
            'type' => $user->getSearchType(),
            'id' => $user->id,
            'body' => $user->toSearchArray()
        ]);
    }

    public function deleted(User $user)
    {
        $this->elasticsearch->index([
            'index' => $user->getSearchIndex(),
            'type' => $user->getSearchType(),
            'id' => $user->id,
        ]);
    }
}
