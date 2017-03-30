<?php

namespace App\Http\Controllers;

class DeveloperController extends Controller
{
    public function svg()
    {

        $files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/../resources/assets/svg/'), array('..', '.'));

        return view(
            'dev.svg',
            [
                'files' => $files,
            ]
        );
    }

}
