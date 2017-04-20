<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TvRepository;
use Illuminate\Http\Request;

class TvController extends Controller
{
    public function index()
    {
        $tvs = TvRepository::getTvsForFront();

        return response()->json($tvs);
    }

    public function show($id)
    {
        $tv = TvRepository::transformTvToFront(
            TvRepository::getTvById($id)
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
