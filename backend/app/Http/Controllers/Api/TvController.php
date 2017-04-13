<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TvRepository;
use Illuminate\Http\Request;

class TvController extends Controller
{
    public function index()
    {
        $notebooks = TvRepository::getTvsForFront();

        return response()->json($notebooks);
    }

    public function show(Request $request)
    {
        $tv = TvRepository::transformTvToFront(
            TvRepository::getTvsByBrandAndModel(
                $request->brand,
                $request->model
            )
        );

        return response()->json($tv);
    }

    public function search(Request $request)
    {
        $notebooks = TvRepository::transformTvsForFront(
            TvRepository::getTvsByParams(
                [
                    'text' => $request->text,
                ]
            )
        );

        return response()->json($notebooks);
    }
}
