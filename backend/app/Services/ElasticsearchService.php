<?php

namespace App\Services;

use App\Models\SearchableModel;
use Elasticsearch\ClientBuilder;

class ElasticSearchService
{
    const DEFAULT_PAGE_SIZE = 15;
    const DEFAULT_START_PAGE = 1;

    private $elasticsearch;
    private $model;
    private $page = self::DEFAULT_START_PAGE;
    private $page_size = self::DEFAULT_PAGE_SIZE;

    /**
     * ElasticSearchService constructor.
     * @param SearchableModel $model
     */
    public function __construct(SearchableModel $model)
    {
        $this->model = $model;
        $this->elasticsearch = ClientBuilder::create()->build();
    }

    /**
     * @param array $query
     *
     * @return array
     */
    public function search($query = [])
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    /**
     * @param $query
     * @return array
     */
    private function searchOnElasticsearch($query)
    {
        $searchString = $query['search'] ?? '';
        unset($query['search']);

        $elasticQuery = $this->parseQueryToElastic(self::escapeString($searchString));

        $this->page = $query['page'] ?? self::DEFAULT_START_PAGE;
        unset($query['page']);

        $this->page_size = $query['size'] ?? self::DEFAULT_PAGE_SIZE;
        unset($query['size']);

        $filters = $this->parseQueryToElasticFilter($query);
        $items = $this->elasticsearch->search(
            [
                'index' => $this->model->getSearchIndex(),
                'type' => $this->model->getSearchType(),
                'body' => [
                    'from' => ($this->page - self::DEFAULT_START_PAGE) * $this->page_size,
                    'size' => $this->page_size,
                    'query' => [
                        'bool' => [
                            'must' => [
                                [
                                    'query_string' => [
                                        'query' => $elasticQuery,
                                        'fields' => $this->model::SEARCH,
                                    ],
                                ],
                            ],
                            'filter' => [
                                'bool' => [
                                    'must' => $filters,
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        return $items;
    }

    /**
     * @param $query
     * @return string
     */
    private function parseQueryToElastic($query)
    {
        $searchWords = explode(' ', $query);
        $elasticQuery = '';
        foreach ($searchWords as $word) {
            $elasticQuery .= '*' . $word . '*';
            if (next($searchWords)) {
                $elasticQuery .= ' ';
            }
        }

        return $elasticQuery;
    }

    /**
     * @param $query
     * @return array
     */
    private function parseQueryToElasticFilter($query)
    {
        $filter = [];
        foreach ($query as $key => $value) {
            if ($value !== '') {
                $key = strpos($key, '_id') !== false
                    ? str_replace('_id', '.id', $key)
                    : $key;
                $filter[] = [
                    'match' => [
                        $key => $value,
                    ],
                ];
            }
        }

        return $filter;
    }

    /**
     * @param $items
     * @return array
     */
    private function buildCollection($items)
    {
        $models = [];
        if(count($items['hits']['hits'])) {
            $maxBoost = $items['hits']['hits'][0]['_score'];
            $resultsWithMaxBoost = array_filter($items['hits']['hits'], function($item) use($maxBoost) {
               return $item['_score'] === $maxBoost;
            });

            foreach ($resultsWithMaxBoost as $item) {
                $model = new $this->model;
                $model->setRawAttributes($item['_source'], true);
                $models[] = $model;
            }
        }

        $response = [
            'total' => $items['hits']['total'],
            'pages' => ceil($items['hits']['total'] / $this->page_size) ?: self::DEFAULT_START_PAGE,
            'current' => count($models),
            'current_page' => $this->page,
            'per_page' => $this->page_size,
            'data' => $models
        ];

        return $response;
    }

    public static function escapeString($source)
    {
        return str_replace(['/'], '', $source);
    }
}
