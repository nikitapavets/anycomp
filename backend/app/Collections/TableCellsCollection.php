<?php

namespace App\Collections;

use App\Classes\Table\TableCell;
use App\Classes\Table\TableEditCell;
use App\Classes\Table\TableLinkCell;
use App\Classes\Table\TablePopupCell;

/**
 * Class TableCellsCollection
 * @package App\Collections
 */
class TableCellsCollection
{
    private $_tableCells;

    /**
     * TableCellsCollection constructor.
     */
    function __construct()
    {
        $this->_tableCells = [];
    }

    /**
     * @param TableCell $tableCell
     */
    public function pushTableCell($tableCell)
    {
        if ($tableCell instanceof TableCell) {
            array_push($this->_tableCells, $tableCell);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $tableCellsArray = [];
        foreach ($this->getTableCells() as $tableCell) {
            $tableCellsArray[] = [
                'cell_value' => $tableCell->getValue(),
                'cell_class' => $tableCell->getClass(),
                'cell_type' => $tableCell->getType(),
                'cell_link_href' => $tableCell instanceof TableLinkCell ? $tableCell->getLinkHref() : '',
                'cell_link_target' => $tableCell instanceof TableLinkCell ? $tableCell->getLinkTarget() : '',
                'cell_link_class' => $tableCell instanceof TableLinkCell ? $tableCell->getLinkClass() : '',
                'cell_popup' => $tableCell instanceof TablePopupCell ? $tableCell->getTablePopupItems()->toArray() : '',
                'cell_data_id' => $tableCell instanceof TableEditCell ? $tableCell->getDataId() : '',
            ];
        }

        return $tableCellsArray;
    }

    /**
     * @return TableCell[]
     */
    public function getTableCells()
    {
        return $this->_tableCells;
    }
}