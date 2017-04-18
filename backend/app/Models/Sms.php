<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    public static function sendSms($host, $msg, $phone = false)
    {

        $ch = curl_init("http://sms.ru/sms/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if ($host == 'n.pavets') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(

                "api_id" => "DD03B1CD-4602-7263-7208-42F4EF27DF7E",
                "to" => $phone ? $phone : "375336136132",
                "from" => "375336136132",
                "translit" => "0",
                "text" => iconv("utf-8", "windows-1251", $msg),

            ));
        }
        if ($host == 'd.karimov') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(

                "api_id" => "E9B5E326-095D-8C06-38D4-C1482F4172AA",
                "to" => $phone ? $phone : "375297175804",
                "from" => "375297175804",
                "translit" => "0",
                "text" => iconv("utf-8", "windows-1251", $msg),

            ));
        }

        $body = curl_exec($ch);
        curl_close($ch);

        return $body;
    }
}
