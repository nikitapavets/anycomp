<?php

namespace App\Classes\Front;


use App\Collections\Collections\SectionItemsCollection;

class Section
{
    private $title;
    /**
     * @var SectionItemsCollection $items
     */
    private $items;

    function __construct($title = '')
    {
        $this->setTitle($title);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
}
