<?php

namespace App\Collections;

use App\Classes\Table\TablePopupInlineLinkItem;
use App\Classes\Table\TablePopupItem;
use App\Classes\Table\TablePopupLinkItem;

/**
 * Class TablePopupItemCollection
 * @package App\Collections
 */
class TablePopupItemCollection
{
    private $_tablePopupItems;

    /**
     * TablePopupItemCollection constructor.
     */
    function __construct()
    {
        $this->_tablePopupItems = [];
    }

    /**
     * @param TablePopupItem $tablePopupItems
     */
    public function pushTablePopupItem($tablePopupItems)
    {
        if ($tablePopupItems instanceof TablePopupItem) {
            array_push($this->_tablePopupItems, $tablePopupItems);
        }
    }

    /**
     * @return TablePopupItem[]
     */
    public function getTablePopupItems()
    {
        return $this->_tablePopupItems;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $tablePopupItemsArray = [];
        foreach ($this->getTablePopupItems() as $tablePopupItem) {
            $tablePopupItemsArray[] = [
                'popup_type' => $tablePopupItem->getType(),
                'popup_value' => $tablePopupItem->getValue(),
                'popup_form' => $tablePopupItem->getForm(),
                'popup_class' => $tablePopupItem->getClass(),
                'popup_link_href' =>
                    $tablePopupItem instanceof TablePopupLinkItem ? $tablePopupItem->getLinkHref() : '',
                'popup_link_target' =>
                    $tablePopupItem instanceof TablePopupLinkItem ? $tablePopupItem->getLinkTarget() : '',
                'popup_inline-link_data_action' =>
                    $tablePopupItem instanceof TablePopupInlineLinkItem ? $tablePopupItem->getDataAction() : '',
                'popup_inline-link_data_id' =>
                    $tablePopupItem instanceof TablePopupInlineLinkItem ? $tablePopupItem->getDataId() : '',
                'popup_inline-link_data_selected' =>
                    $tablePopupItem instanceof TablePopupInlineLinkItem ? $tablePopupItem->getDataSelected() : '',
            ];
        }
        return $tablePopupItemsArray;
    }
}