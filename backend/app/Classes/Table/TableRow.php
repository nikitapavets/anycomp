<?php

namespace App\Classes\Table;

use App\Collections\TableCellsCollection;

/**
 * Class TableTabs
 * @package App\Classes\Widget
 */
class TableRow
{
    /**
     * @var TableCellsCollection
     */
    private $_cells;

    function __construct($cells)
    {
        $this->_cells = $cells;
    }

    /**
     * @return TableCellsCollection
     */
    public function getCells()
    {
        return $this->_cells;
    }

    /**
     * @param TableCellsCollection $cells
     */
    public function setCells($cells)
    {
        $this->_cells = $cells;
    }
}