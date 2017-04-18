<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderUserRequest;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Sms;
use App\Repositories\ClientRepository;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{
    public function client(OrderUserRequest $request)
    {
        $client = $request;
        $client['rang'] = Client::RANG_NO_REGISTERED;

        return response()->json($client);
    }

    public function products(Request $request)
    {
        $client = ClientRepository::saveClient($request);
        $order = OrderRepository::saveOrder($client);
        foreach ($request->products as $product) {
            OrderProductRepository::saveOrderProduct($product, $order);
        }
        if(Config::get('sms.notification.new_order')) {
            $host = Config::get('sms.host');
            $msg = 'Оформлен заказ №'.$order->getId().' - AnyComp.by';
            Sms::sendSms($host, $msg);
        }


        return response()->json($order);
    }
}
