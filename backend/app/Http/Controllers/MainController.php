<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MainController extends Controller
{
    public function index() {

        $page = [
            'title' => 'AnyComp | Ремонт и обслуживание компьютерной техники',
            'desc' => 'AnyComp - продажи и ремонт компьютерной техники, установка и обслуживание спутникового TV и видеонаблюдения.',
	        'css' => '/styles/main.min.css',
	        'css_header' => '/styles/header.min.css',
	        'scripts' => '/scripts/main.min.js'
        ];

        return view('client', [
            'page' => $page
        ]);
    }

}
