<?php

namespace App\Classes\Widget;


use App\Models\Database;

class WidgetSelect extends Widget
{
    const TYPE_SELECT = 'select';
    const DEFAULT_GAG = 'Выбор';

    private $_select_gag;
    private $_select_items;
    private $_is_allow_add;
    private $_allow_add_name;
    private $_select_gag_selected;

    function __construct($label = '', $name = '', $isRequired = false)
    {
        parent::__construct($label, $name, self::TYPE_SELECT, (bool)$isRequired);
        $this->_select_gag = self::DEFAULT_GAG;
        $this->_select_gag_selected = self::DEFAULT_GAG;
        $this->_select_items = [];
        $this->_is_allow_add = false;
        $this->_allow_add_name = '';
    }

    /**
     * @return string
     */
    public function getSelectGag()
    {
        return $this->_select_gag;
    }

    /**
     * @param string $selectGag
     */
    public function setSelectGag($selectGag)
    {
        $this->_select_gag = $selectGag;
    }

    /**
     * @return string
     */
    public function getSelectGagSelected()
    {
        return $this->_select_gag_selected;
    }

    /**
     * @param string $selectGagSelected
     */
    public function setSelectGagSelected($selectGagSelected)
    {
        $this->_select_gag_selected = $selectGagSelected;
    }

    /**
     * @param Database $dbItem
     */
    public function setValue($dbItem)
    {
        if ($dbItem) {
            parent::setValue($dbItem->getId());
            if ($dbItem) {
                $this->setSelectGagSelected($dbItem->getName(true));
            }
        }
    }

    /**
     * @return array
     */
    public function getSelectItems()
    {
        return $this->_select_items;
    }

    /**
     * @param array $selectItems
     */
    public function setSelectItems($selectItems)
    {
        $this->_select_items = $this->toSelectItems($selectItems);
    }

    /**
     * @param Database[] $collection
     * @return array
     */
    public function toSelectItems($collection)
    {
        $selectItems = [];
        foreach ($collection as $item) {
            $selectItems[] = array(
                'id' => $item->getId(),
                'value' => $item->getName(),
                'selected' => $item->getId() == $this->getValue() ? 'selected' : '',
            );
        }

        return $selectItems;
    }

    /**
     * @return bool
     */
    public function isAllowAdd()
    {
        return (bool)$this->_is_allow_add;
    }

    /**
     * @return string
     */
    public function getAllowAddName()
    {
        return $this->_allow_add_name;
    }

    /**
     * @param $allowAddName
     */
    public function setAllowAddName($allowAddName)
    {
        $this->setAllowAdd($allowAddName);
        $this->_allow_add_name = $allowAddName;
    }

    /**
     * @param bool $isAllowAdd
     */
    public function setAllowAdd($isAllowAdd)
    {
        $this->_is_allow_add = (bool)$isAllowAdd;
    }
}
