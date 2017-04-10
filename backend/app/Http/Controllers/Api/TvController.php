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

    public function show(Request $request)
    {
        $notebook = TvRepository::getTvsByBrandAndModel(
            $request->brand,
            $request->model,
            $request->config
        );

        return response()->json($notebook);
    }

    public function search(Request $request)
    {
        $notebooks = TvRepository::transformTvsForFront(
            TvRepository::getTvsByParams([
                'text' => $request->text
            ])
        );

        return response()->json($notebooks);
    }
}
