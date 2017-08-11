<?php

namespace App\Classes\Page;

class Page
{
    protected $title;
    protected $description;
    protected $viewName;

    public function __construct($title, $viewName = '', $description = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->viewName = $viewName;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getViewName()
    {
        return $this->viewName;
    }
}
