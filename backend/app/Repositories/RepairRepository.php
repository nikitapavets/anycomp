<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
use App\Classes\Table\TableLinkCell;
use App\Classes\Table\TablePopupCell;
use App\Classes\Table\TablePopupInlineLinkItem;
use App\Classes\Table\TablePopupItem;
use App\Classes\Table\TablePopupLinkItem;
use App\Classes\Table\TableRow;
use App\Collections\TableCellsCollection;
use App\Collections\TablePopupItemCollection;
use App\Collections\TableRowsCollection;
use App\Interfaces\ExcelDocument;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairRepository
{
    /**
     * @param int $size
     * @param string $orderBy
     * @return Repair[]
     */
    public static function getRepairs($size = 0, $orderBy = 'id')
    {
        $orderBy = $orderBy ?: 'id';
        if($size) {
            return Repair::orderBy($orderBy, 'desc')->paginate($size);
        } else {
            return Repair::orderBy($orderBy, 'desc')->get();
        }
    }

    /**
     * @return Repair
     */
    public static function getLastRepair()
    {
        return self::getRepairs()[0];
    }

    /**
     * @param $status
     * @param int $size
     * @return Repair[]
     */
    public static function getRepairsByStatus($status, $size = 15)
    {
        $repairs = Repair::where('current_status', '=', $status)
            ->orderBy('id', 'desc');
        if($size) {
            return $repairs->paginate($size);
        }
        return $repairs->get();
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function removeRepairs($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        Repair::destroy($arrayIds);
    }

    /**
     * @param int $id
     * @return Repair
     */
    public static function getRepairById($id)
    {
        return Repair::find($id);
    }

    /**
     * @param Repair[] $repairs
     * @return TableRowsCollection
     */
    public static function repairsToRows($repairs)
    {
        $tableRows = new TableRowsCollection();
        foreach ($repairs as $repair) {

            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($repair->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableLinkCell($repair->receipt_number, TableLinkCell::TYPE_LINK,TableLinkCell::TARGET_SELF);
            $tableCell->setLinkHref($repair->link);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell($repair->full_name);
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_BOX, $repair->full_name);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_SET, $repair->set);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_DEFECT, $repair->defect);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_HASH, $repair->code);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_APPEARANCE, $repair->appearance);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_COMMENT, $repair->comment);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_PRICE, $repair->approximate_cost);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_PLACE, $repair->getReceptionPlace()->getName());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_WORKER, $repair->employee->sf_name);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_CODE, $repair->token);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell($repair->getClient()->getShortName());
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_FULL_NAME, $repair->getClient()->full_name);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_ORGANIZATION,
                $repair->getClient()->getOrganization()->getName()
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_PHONE,
                $repair->getClient()->mobile_phone_native
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_PHONE_HOME,
                $repair->getClient()->home_phone_native
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_ADDRESS, $repair->getClient()->address);
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($repair->getClient()->mobile_phone_native);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($repair->issued_at);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Действия');
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_EDIT, 'Изменить');
            $tablePopupItem->setLinkHref(route('admin.repairs.edit', ['id' => $repair->getId()]));
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_XLS, 'Квитанция');
            $tablePopupItem->setLinkHref(route('admin.repairs.print_doc', ['id' => $repair->id]));
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }

    public static function makeReceiptNumber()
    {
        $lastRepair = RepairRepository::getLastRepair();
        $nextReceiptNumber = 'AC' . date('dmy/1');
        if ($lastRepair) {
            if (substr($lastRepair->receipt_number, 2, 6) == date('dmy')) {
                $nextReceiptNumber = (int)substr($lastRepair->receipt_number, 9) + 1;
                $nextReceiptNumber = 'AC' . date('dmy/') . $nextReceiptNumber;
            }
        }

        return $nextReceiptNumber;
    }

    /**
     * @param Repair[] $repairs
     * @return array
     */
    public static function repairToStatistics($repairs)
    {
        $statistics = [];
        $result = [];

        foreach ($repairs as $repair) {
            $statistics[$repair->getCreatedAtYear()][$repair->getCreatedAtMonth()][$repair->getCreatedAtDay()][] = 1;
        }
        foreach ($statistics as $keyYear => $year) {
            foreach ($year as $keyMonth => $month) {
                $result[$keyYear][] = ['x' => $keyMonth, 'y' => count($month)];
            }
        }

        return $result;
    }

    public static function printReceipt(Repair $repair)
    {
        $fileInfo = array(
            'file_name' => 'Квитанция о приеме в ремонт № ' . $repair->receipt_number . ' от ' . $repair->created_at_native,
            'list_name' => 'Квитанция о приеме в ремонт',
        );
        $orgInfo = array(
            'org_name' => 'ЧТУП "ЭниКомп"',
            'org_address' => 'г. Лепель, ул. Ленинская, д. 9, каб. 1',
            'org_phone' => '8-02132-4-62-62',
        );

        $excel = new ExcelDocument();
        $excel->create($fileInfo, $orgInfo, $repair);
    }
}
