<?php

namespace App\Search;

use App\Observers\ElasticsearchClientObserver;
use App\Observers\ElasticsearchRepairObserver;

trait Searchable
{
    public function getSearchIndex()
    {
        return $this->getTable();
    }

    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }

    public function toSearchArray()
    {
        return $this->toArray();
    }
}
