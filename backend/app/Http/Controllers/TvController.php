<?php

namespace App\Http\Controllers;

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
