<?php

namespace App\Classes\Page;

class TablePage extends Page
{
    protected $viewName = 'admin.blocks.table';

    public function __construct($title, $description = 'Вы можете добавлять, изменять и удалять элементы из списка.')
    {
        parent::__construct($title, $this->viewName, $description);
    }
}
