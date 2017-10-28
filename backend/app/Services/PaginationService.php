<?php

namespace App\Services;


use App\Models\Repair;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationService extends LengthAwarePaginator
{
    const DEFAULT_PAGE_SIZE = 15;

    public function __construct(Model $model, $elasticsearchResult, $appends = [], $options = [])
    {
        $data = $model::whereIn('id', collect($elasticsearchResult['data'])->pluck('id'))->get();

        parent::__construct(
            $data,
            $elasticsearchResult['total'],
            $elasticsearchResult['per_page'],
            $elasticsearchResult['current_page'],
            $options
        );

        $this->appends($appends);
    }
}
