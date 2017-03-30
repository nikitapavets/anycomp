<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
use App\Classes\Table\TableEditCell;
use App\Classes\Table\TableRow;
use App\Collections\TableCellsCollection;
use App\Collections\TableRowsCollection;
use App\Models\Database;
use Illuminate\Http\Request;

class DatabaseRepository
{
    /**
     * @return Database[]
     */
    public static function getDatabaseItems($class)
    {
        return $class::where('id', '!=', Database::NO_SELECTED)
            ->orderBy('id', 'name')
            ->get();
    }

    /**
     * @param Database $class
     * @param $stringIds
     * @param string $delimiter
     */
    public static function removeDatabaseItems($class, $stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        $class::destroy($arrayIds);
    }

    public static function getDatabaseItemById($class, $id)
    {
        return $class::find($id);
    }

    /**
     * @param Database[] $databaseItems
     * @return TableRowsCollection
     */
    public static function databaseToRows($databaseItems)
    {
        $tableRows = new TableRowsCollection();
        $index = 1;
        foreach ($databaseItems as $databaseItem) {
            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($databaseItem->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($index++);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableEditCell($databaseItem->getName());
            $tableCell->setDataId($databaseItem->getId());
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }

    /**
     * @param Database $class
     * @param Request $request
     */
    public static function saveDatabaseItem($class, Request $request)
    {
        /**
         * @var Database $databaseItem
         */
        $databaseItem = $class::firstOrNew(['id' => $request->itemId ?? 0]);
        $databaseItem->setName($request->itemName);
        $databaseItem->save();
    }
}
