<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\ClientRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return response()->json($client ? ClientRepository::clientToArray($client) : false);
    }

    public function post(Request $request)
    {
        $client = ClientRepository::auth($request->client_email, $request->client_password);

        return response()->json($client ? ClientRepository::clientToArray($client) : 'Email или пароль введены неверно');
    }
}
