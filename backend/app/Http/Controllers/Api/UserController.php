<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(['index']);
    }

    public function store(Request $request)
    {
        return response()->json(['store2']);
    }
}
