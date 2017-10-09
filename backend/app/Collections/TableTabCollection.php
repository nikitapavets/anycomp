<?php

namespace App\Collections;

use App\Classes\Table\TableTab;

/**
 * Class TableTabCollection
 * @package App\Classes\Collections
 */
class TableTabCollection
{
    private $_tableTabs;

    /**
     * TableTabCollection constructor.
     */
    function __construct()
    {
        $this->_tableTabs = [];
    }

    /**
     * @param TableTab $tableTab
     */
    public function pushTableTab($tableTab)
    {
        if ($tableTab instanceof TableTab) {
            array_push($this->_tableTabs, $tableTab);
        }
    }

    /**
     * @return TableTab[]
     */
    public function getTableTabs()
    {
        return $this->_tableTabs;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $tableTabsArray = [];
        foreach ($this->getTableTabs() as $tableTab) {
            $tableTabsArray[] = [
                'tab_name' => $tableTab->getName(),
                'tab_status' => $tableTab->getStatus(),
            ];
        }

        return $tableTabsArray;
    }

    /**
     * @return array
     */
    public function toRowsArray()
    {
        $rowsArray = [];
        foreach ($this->getTableTabs() as $tableTab) {
            $rowsArray[] = $tableTab->getRows() ? $tableTab->getRows()->toArray() : [];
        }
        return $rowsArray;
    }

    public function toPaginationArray()
    {
        $rowsArray = [];
        foreach ($this->getTableTabs() as $tableTab) {
            $pagination = $tableTab->getPagination();
            $rowsArray[] = $pagination ? $pagination->toArray() : false;
        }
        return $rowsArray;
    }
}