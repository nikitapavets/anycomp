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
use App\Interfaces\GeneralRepository;
use App\Models\Delivery;

class DeliveryRepository implements GeneralRepository
{
    private static $link = 'deliveries';

    /**
     * @param int $size
     * @param string $orderBy
     * @return Delivery[]
     */
    public static function get($size = 0, $orderBy = 'id')
    {
        $orderBy = $orderBy ?: 'id';
        if($size) {
            return Delivery::orderBy($orderBy, 'desc')->paginate($size);
        } else {
            return Delivery::orderBy($orderBy, 'desc')->get();
        }
    }

    /**
     * @param int $id
     * @return Delivery
     */
    public static function getById($id)
    {
        return Delivery::find($id);
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function destroy($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        Delivery::destroy($arrayIds);
    }

    /**
     * @param Delivery[] $deliveries
     * @return TableRowsCollection
     */
    public static function toTableRows($deliveries)
    {
        $tableRows = new TableRowsCollection();
        foreach ($deliveries as $delivery) {

            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($delivery->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableLinkCell($delivery->getCreatedAt());
            $tableCell->setLinkHref($delivery->getLink());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($delivery->getWorker()->getName());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Действия');
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_EDIT, 'Изменить');
            $tablePopupItem->setLinkHref(sprintf('%s/edit', $delivery->getLink()));
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }

    public static function getLink()
    {
        return sprintf("%s/%s", config('links.admin'), self::$link);
    }
}
