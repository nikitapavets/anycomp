<?php

namespace App\Collections;

use App\Classes\Table\TableRow;

/**
 * Class TableRowsCollection
 * @package App\Collections
 */
class TableRowsCollection
{
    private $_tableCells;

    /**
     * TableRowsCollection constructor.
     */
    function __construct()
    {
        $this->_tableRows = [];
    }

    /**
     * @param TableRow $tableRow
     */
    public function pushTableCell($tableRow)
    {
        if ($tableRow instanceof TableRow) {
            array_push($this->_tableRows, $tableRow);
        }
    }

    /**
     * @return TableRow[]
     */
    public function getTableRows()
    {
        return $this->_tableRows;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $tableRowsArray = [];
        foreach ($this->getTableRows() as $tableRow) {
            $tableRowsArray[] = $tableRow->getCells()->toArray();
        }
        return $tableRowsArray;
    }
}