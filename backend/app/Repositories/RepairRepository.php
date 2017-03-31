<?php

namespace App\Repositories;

use App\Classes\Table\TableCell;
use App\Classes\Table\TablePopupCell;
use App\Classes\Table\TablePopupInlineLinkItem;
use App\Classes\Table\TablePopupItem;
use App\Classes\Table\TablePopupLinkItem;
use App\Classes\Table\TableRow;
use App\Collections\TableCellsCollection;
use App\Collections\TablePopupItemCollection;
use App\Collections\TableRowsCollection;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairRepository
{
    /**
     * @return Repair[]
     */
    public static function getRepairs()
    {
        return Repair::orderBy('id', 'desc')->get();
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
     * @return Repair[]
     */
    public static function getRepairsByStatus($status)
    {

        return Repair::where('current_status', '=', $status)
            ->orderBy('id', 'desc')
            ->get();
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

            $tableCell = new TableCell($repair->getReceiptNumber());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell($repair->getFullName());
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_BOX, $repair->getFullName());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_SET, $repair->getSet());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_DEFECT, $repair->getDefect());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_HASH, $repair->getHashCode());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_COMMENT, $repair->getComment());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_WORKER, $repair->getWorker()->getSFName());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_CODE, $repair->getCode());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell($repair->getClient()->getShortName());
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_FULL_NAME, $repair->getClient()->getFullName());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_ORGANIZATION,
                $repair->getClient()->getOrganization()->getName()
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_PHONE,
                $repair->getClient()->getMobilePhoneOnNativeFormat()
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_PHONE_HOME,
                $repair->getClient()->getHomePhoneOnNativeFormat()
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_ADDRESS, $repair->getClient()->getAddress());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($repair->getCreatedAt());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Действия');
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_EDIT, 'Изменить');
            $tablePopupItem->setLinkHref('/admin/repair/'.$repair->getId().'/update');
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupInlineLinkItem(TablePopupItem::TYPE_STATUS, 'Статус');
            $tablePopupItem->setClass(TablePopupInlineLinkItem::CLASS_REPAIR_STATUS);
            $tablePopupItem->setDataAction('/admin/repair/update_status');
            $tablePopupItem->setDataId($repair->getId());
            $tablePopupItem->setDataSelected($repair->getStatus());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_XLS, 'Квитанция');
            $tablePopupItem->setLinkHref('/admin/repair/print_doc?id='.$repair->getId());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }

    /**
     * @param Repair $repair
     * @param $newStatus
     */
    public static function updateRepairStatus($repair, $newStatus)
    {
        if ($repair instanceof Repair) {
            $repair->update(['current_status' => $newStatus]);
        }
    }

    /**
     * @param Request $request
     */
    public static function saveRepair(Request $request)
    {
        DB::transaction(
            function () use ($request) {
                /**
                 * @var Client $client
                 */
                $client = Client::firstOrNew(['id' => $request->client_id ?? 0]);
                $client->setSecondName($request->client_second_name);
                $client->setFirstName($request->client_first_name);
                $client->setFatherName($request->client_father_name);
                $client->setOrganization($request->client_organization_id, $request->client_organization_new);
                $client->setMobilePhone($request->client_mobile_phone);
                $client->setHomePhone($request->client_home_phone);
                $client->setCity($request->client_city_type_id, $request->client_city_type_new);
                $client->setCityType($request->client_city_type_id, $request->client_city_type_new);
                $client->setCity($request->client_city_id, $request->client_city_new);
                $client->setStreet($request->client_street);
                $client->setStreet($request->client_street);
                $client->setHouse($request->client_house);
                $client->setFlat($request->client_flat);
                $client->save();
                /**
                 * @var Repair $repair
                 */
                $repair = Repair::firstOrNew(['id' => $request->repair_id ?? 0]);
                $repair->setClient($client);
                $repair->setAdmin(Admin::getAuthAdmin());
                $repair->setReceiptNumber(RepairRepository::makeReceiptNumber());
                $repair->setCode();
                $repair->setCategory($request->product_category_id, $request->product_category_new);
                $repair->setBrand($request->product_brand_id, $request->product_brand_new);
                $repair->setTitle($request->product_title);
                $repair->setDefect($request->product_defect);
                $repair->setHashCode($request->product_code);
                $repair->setSet($request->product_set);
                $repair->setComment($request->product_comment);
                $repair->setWorker($request->worker_id);

                $repair->save();
            }
        );
    }

    public static function makeReceiptNumber()
    {
        $lastRepair = RepairRepository::getLastRepair();
        $nextReceiptNumber = 'AC'.date('dmy/1');
        if ($lastRepair) {
            if (substr($lastRepair->getReceiptNumber(), 2, 6) == date('dmy')) {
                $nextReceiptNumber = (int)substr($lastRepair->getReceiptNumber(), 9) + 1;
                $nextReceiptNumber = 'AC'.date('dmy/').$nextReceiptNumber;
            }
        }

        return $nextReceiptNumber;
    }
}
