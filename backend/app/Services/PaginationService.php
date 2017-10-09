<?php

namespace App\Services;


use App\Models\Repair;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationService extends LengthAwarePaginator
{
    public function __construct($elasticsearchResult, $appends = [], $options = [])
    {
        $data = Repair::whereIn('id', collect($elasticsearchResult['data'])->pluck('id'))->get();

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
