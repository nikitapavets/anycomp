<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
use App\Classes\Table\TableLinkCell;
use App\Classes\Table\TablePopupCell;
use App\Classes\Table\TablePopupItem;
use App\Classes\Table\TablePopupLinkItem;
use App\Classes\Table\TableRow;
use App\Collections\TableCellsCollection;
use App\Collections\TablePopupItemCollection;
use App\Collections\TableRowsCollection;
use App\Models\Delivery;

class DeliveryRepository
{
    /**
     * @param Delivery[] $deliveries
     * @return TableRowsCollection
     */
    public static function toTableRows($deliveries)
    {
        $tableRows = new TableRowsCollection();
        foreach ($deliveries as $delivery) {

            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($delivery->id);
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableLinkCell($delivery->delivered_at_date);
            $tableCell->setLinkHref('#');
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($delivery->employee->sf_name);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($delivery->spares()->count());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Действия');
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_EDIT, 'Изменить');
            $tablePopupItem->setLinkHref(route('admin.deliveries.edit', ['id' => $delivery->id]));
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }
}
