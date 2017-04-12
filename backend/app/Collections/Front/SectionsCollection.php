<?php

namespace App\Collections\Front;

use App\Classes\Front\Section;

class SectionsCollection
{
    private $sections;

    function __construct()
    {
        $this->sections = [];
    }

    /**
     * @param Section $section
     */
    public function pushSection($section)
    {
        if ($section instanceof Section) {
            array_push($this->sections, $section);
        }
    }

    /**
     * @return Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $sectionsArray = [];
        foreach ($this->getSections() as $section) {
            $sectionsArray[] = [
                'title' => $section->getTitle(),
                'items' => $section->getItems()->toArray()
            ];
        }

        return $sectionsArray;
    }
}