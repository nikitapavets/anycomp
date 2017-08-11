<?php

namespace App\Classes\Page;

class FormPage extends Page
{
    protected $viewName = 'admin.blocks.form';

    public function __construct($title, $description = 'Будьте внимательны, заполняя поля формы.')
    {
        parent::__construct($title, $this->viewName, $description);
    }
}
