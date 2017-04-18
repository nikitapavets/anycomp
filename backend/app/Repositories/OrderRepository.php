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
use App\Models\Client;
use App\Models\Order;

class OrderRepository
{
    /**
     * @return Order[]
     */
    public static function getOrders()
    {
        return Order::orderBy('id', 'desc')->get();
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function removeOrders($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        Order::destroy($arrayIds);
    }

    public static function saveOrder(Client $client)
    {
        /**
         * @var Order $client
         */
        $order = new Order();
        $order->setClient($client);
        $order->save();

        return $order;
    }

    /**
     * @param Order[] $orders
     * @return TableRowsCollection
     */
    public static function ordersToRows($orders)
    {
        $tableRows = new TableRowsCollection();
        $index = 1;
        foreach ($orders as $order) {

            $tableCells = new TableCellsCollection();

            $tableCell = new TableCell($order->getId());
            $tableCell->setClass(TableCell::CLASS_CHECKER);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($index++);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($order->getId());
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell($order->getClient()->getShortName());
            $tablePopupItems = new TablePopupItemCollection();
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_FULL_NAME, $order->getClient()->getFullName());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_ORGANIZATION,
                $order->getClient()->getOrganization()->getName()
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_PHONE,
                $order->getClient()->getMobilePhoneOnNativeFormat()
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(
                TablePopupItem::TYPE_PHONE_HOME,
                $order->getClient()->getHomePhoneOnNativeFormat()
            );
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tablePopupItem = new TablePopupItem(TablePopupItem::TYPE_ADDRESS, $order->getClient()->getAddress());
            $tablePopupItems->pushTablePopupItem($tablePopupItem);
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TablePopupCell('Товаров: '.count($order->getOrderProducts()));
            $tablePopupItems = new TablePopupItemCollection();
            foreach ($order->getOrderProducts() as $orderProduct) {
                $tablePopupItem = new TablePopupLinkItem(TablePopupItem::TYPE_BOX, $orderProduct->getProduct()->getFullName());
                $tablePopupItem->setLinkHref($orderProduct->getProduct()->getLink());
                $tablePopupItems->pushTablePopupItem($tablePopupItem);
            }
            $tableCell->setTablePopupItems($tablePopupItems);
            $tableCells->pushTableCell($tableCell);

            $tableCell = new TableCell($order->getCreatedAt());
            $tableCells->pushTableCell($tableCell);

            $tableRow = new TableRow($tableCells);
            $tableRows->pushTableCell($tableRow);
        }

        return $tableRows;
    }
}