<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;

class OrderProductRepository
{
    /**
     * @return OrderProduct[]
     */
    public static function getOrderProducts()
    {
        return OrderProduct::orderBy('id', 'desc')->get();
    }

    /**
     * @param string $stringIds
     * @param string $delimiter
     */
    public static function removeOrderProducts($stringIds, $delimiter = ',')
    {
        $arrayIds = explode($delimiter, $stringIds);
        OrderProduct::destroy($arrayIds);
    }

    public static function saveOrderProduct($orderProductRequest, Order $order)
    {
        /**
         * @var OrderProduct $client
         */
        $orderProduct = new OrderProduct();
        $orderProduct->setProductType($orderProductRequest['orderType']);
        $orderProduct->setProduct($orderProductRequest['id']);
        $orderProduct->setOrder($order);
        $orderProduct->save();

        return $orderProduct;
    }
}