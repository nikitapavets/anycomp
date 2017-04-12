<?php

namespace App\Collections\Front;

use App\Classes\Front\SectionCheckerItem;
use App\Classes\Front\SectionItem;

class SectionItemsCollection
{
    private $sectionItems;

    function __construct()
    {
        $this->sectionItems = [];
    }

    /**
     * @param SectionItem $sectionItem
     */
    public function pushSectionItem($sectionItem)
    {
        if ($sectionItem instanceof SectionItem) {
            array_push($this->sectionItems, $sectionItem);
        }
    }

    /**
     * @return SectionItem[]
     */
    public function getSectionItems()
    {
        return $this->sectionItems;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $sectionItemsArray = [];
        foreach ($this->getSectionItems() as $sectionItem) {
            $sectionItemsArray[] = [
                'title' => $sectionItem->getTitle(),
                'value' => $sectionItem->getValue(),
                'type' => $sectionItem->getType(),
                'checker_value' => $sectionItem instanceof SectionCheckerItem ? $sectionItem->getCheckerValue() : '',
            ];
        }

        return $sectionItemsArray;
    }
}