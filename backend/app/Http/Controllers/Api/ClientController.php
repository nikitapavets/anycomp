<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientSearchRequest;
use App\Models\Client;
use App\Services\ElasticSearchService;

class ClientController extends Controller
{
    public function search(ClientSearchRequest $request)
    {
        $elasticSearchService = new ElasticSearchService(new Client());
        $clients = $elasticSearchService->search($request->all());

        return response()->success($clients);
    }
}
