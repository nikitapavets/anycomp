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
use App\Models\Spare;

class SpareRepository implements GeneralRepository
{
    private static $link = 'spares';

    /**
     * @param int $size
     * @param string $orderBy
     * @return Spare[]
     */
    public static function get($size = 0, $orderBy = 'id')
    {
        $orderBy = $orderBy ?: 'id';
        if($size) {
            return Spare::orderBy($orderBy, 'desc')->paginate($size);
        } else {
            return Spare::orderBy($orderBy, 'desc')->get();
        }
    }

    /**
     * @param int $id
     * @return Spare
     */
    public static function getById($id)
    {
        return Spare::find($id);
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function destroy($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        Spare::destroy($arrayIds);
    }

    /**
     * @param Spare[] $spares
     * @return TableRowsCollection
     */
    public static function toTableRows($spares)
    {
        $tableRows = new TableRowsCollection();
        foreach ($spares as $spare) {

            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($spare->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($spare->getFullName());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($spare->getOrganization()->getName());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableLinkCell($spare->getDelivery()->getName());
            $tableCell->setLinkHref($spare->getDelivery()->getLink());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($spare->getQuantity());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($spare->getPrice());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Действия');
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_EDIT, 'Изменить');
            $tablePopupItem->setLinkHref(sprintf('%s/edit', $spare->getLink()));
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }

    public function store(Request $request)
    {

    }

    public static function getLink()
    {
        return sprintf("%s/%s", config('links.admin'), self::$link);
    }
}
