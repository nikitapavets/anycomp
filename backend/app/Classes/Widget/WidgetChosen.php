<?php

namespace App\Classes\Widget;


use App\Models\Database;

class WidgetChosen extends Widget
{
    const TYPE_CHOSEN = 'chosen';

    private $_chosen_items;

    function __construct($label = '', $name = '', $isRequired = false)
    {
        parent::__construct($label, $name, self::TYPE_CHOSEN, (bool)$isRequired);
    }

    /**
     * @return array
     */
    public function getChosenItems()
    {
        return $this->_chosen_items;
    }

    /**
     * @param array $chosenItems
     */
    public function setChosenItems($chosenItems)
    {
        $this->_chosen_items = $this->toChosenItems($chosenItems);
    }

    /**
     * @param Database[] $collection
     * @return array
     */
    public function toChosenItems($collection)
    {
        $chosenItems = [];
        $chosenItemsIndex = 0;
        foreach ($collection as $item) {
            $chosenItems[] = array(
                'id' => $item->getId(),
                'value' => $item->getName(),
            );
            if ($this->getValue()) {
                foreach ($this->getValue() as $chosenSelectedItem) {
                    /**
                     * @var Database $chosenSelectedItem
                     */
                    if ($item->getId() == $chosenSelectedItem->getId()) {
                        $chosenItems[$chosenItemsIndex]['selected'] = 'selected';
                    }
                }
                $chosenItemsIndex++;
            }
        }

        return $chosenItems;
    }
}
