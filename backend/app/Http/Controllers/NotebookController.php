<?php

namespace App\Http\Controllers;

use App\Repositories\NotebookRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotebookController extends Controller
{
    public function index()
    {
        $notebooks = NotebookRepository::getNotebooksForFront();

        return response()->json($notebooks);
    }
}
