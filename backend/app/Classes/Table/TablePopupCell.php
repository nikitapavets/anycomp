<?php

namespace App\Classes\Table;

use App\Collections\TablePopupItemCollection;

/**
 * Class TablePopupCell
 * @package App\Classes\Table
 */
class TablePopupCell extends TableLinkCell
{
    const LINK_CLASS_POPUP = 'shopPopupWithDetailedDescription';
    const LINK_HREF_POPUP = 'javascript:;';
    /**
     * @var TablePopupItemCollection
     */
    private $_tablePopupItems;

    function __construct($value, $type = self::TYPE_POPUP)
    {
        parent::__construct($value, $type);

        $this->setLinkClass(self::LINK_CLASS_POPUP);
        $this->setLinkHref(self::LINK_HREF_POPUP);
    }

    /**
     * @return TablePopupItemCollection
     */
    public function getTablePopupItems()
    {
        return $this->_tablePopupItems;
    }

    /**
     * @param TablePopupItemCollection $tablePopupItems
     */
    public function setTablePopupItems($tablePopupItems)
    {
        $this->_tablePopupItems = $tablePopupItems;
    }
}