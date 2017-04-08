<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TvRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class TvController extends Controller
{
    public function index()
    {
        $notebooks = TvRepository::getTvsForFront();

        return response()->json($notebooks);
    }
}
