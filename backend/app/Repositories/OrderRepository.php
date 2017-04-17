<?php

namespace App\Repositories;

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
}