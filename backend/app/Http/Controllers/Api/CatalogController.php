<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Notebook;
use App\Models\Catalog\Tv;
use App\Repositories\NotebookRepository;
use App\Repositories\TvRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CatalogController extends Controller
{
    public function dayOffer()
    {
        $dayOffer = Notebook::first();

        return response()->success($dayOffer);
    }
}
