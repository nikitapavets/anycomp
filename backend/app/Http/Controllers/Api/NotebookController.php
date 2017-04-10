<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\NotebookRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotebookController extends Controller
{
    public function index()
    {
        $notebooks = NotebookRepository::getNotebooksForFront();

        return response()->json(array_merge($notebooks, $notebooks));
    }

    public function show(Request $request)
    {
        $notebook = NotebookRepository::getNotebooksByBrandAndModel(
            $request->brand,
            $request->model,
            $request->config
        );

        return response()->json($notebook);
    }

    public function search(Request $request)
    {
        $notebooks = NotebookRepository::transformNotebooksForFront(
            NotebookRepository::getNotebooksByParams([
                'text' => $request->text
            ])
        );

        return response()->json($notebooks);
    }
}
