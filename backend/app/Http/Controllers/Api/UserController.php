<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\ClientRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $client = ClientRepository::saveClient($request);

        return response()->json(['id' => $client->getId()]);
    }

    public function show($userId)
    {
        $client = ClientRepository::getClientById($userId);

        return response()->json(ClientRepository::clientToArray($client));
    }
}
