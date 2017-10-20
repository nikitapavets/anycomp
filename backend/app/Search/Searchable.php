<?php

namespace App\Search;

use App\Observers\ElasticsearchClientObserver;
use App\Observers\ElasticsearchRepairObserver;
use App\Services\ElasticSearchService;

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
        $searchData = $this->toArray();
        $searchData['receipt_number'] = ElasticSearchService::escapeString($searchData['receipt_number']);

        return $searchData;
    }
}
