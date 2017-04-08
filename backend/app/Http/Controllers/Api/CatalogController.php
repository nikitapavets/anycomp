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
    public function popular()
    {
        $popular = [];
        foreach (NotebookRepository::getPopularNotebooks() as $notebook) {
            $popular[] = [
                'title' => $notebook->getName(),
                'brand' => Notebook::PRODUCT_TITLE.' '.$notebook->getBrand()->getName(),
                'model' => $notebook->getModel(),
                'link' => $notebook->getLink(),
                'image' => $notebook->getBigImage(),
                'price' => $notebook->getPrice(),
            ];
        }
        foreach (TvRepository::getPopularTvs() as $tv) {
            $popular[] = [
                'title' => $tv->getName(),
                'brand' => Tv::PRODUCT_TITLE.' '.$tv->getBrand()->getName(),
                'model' => $tv->getModel(),
                'link' => $tv->getLink(),
                'image' => $tv->getBigImage(),
                'price' => $tv->getPrice(),
            ];
        }

        return response()->json($popular);
    }
}
