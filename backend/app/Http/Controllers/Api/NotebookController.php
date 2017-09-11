<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\NotebookRepository;
use Illuminate\Http\Request;
use App\Models\Catalog\Notebook;

class NotebookController extends Controller
{
    public function index()
    {
        $notebooks = Notebook::orderBy('id', 'desc')
            ->take(5)
            ->get();

        return response()->json($notebooks);
    }

    public function show($id)
    {
        $notebook = NotebookRepository::transformNotebookToFront(
            NotebookRepository::getNotebookById($id)
        );

        return response()->json($notebook);
    }

    public function search(Request $request)
    {
        $notebooks = NotebookRepository::transformNotebooksToFront(
            NotebookRepository::getNotebooksByParams(
                [
                    'text' => $request->text,
                ]
            )
        );

        return response()->json($notebooks);
    }
}
