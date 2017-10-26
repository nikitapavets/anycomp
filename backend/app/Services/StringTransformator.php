<?php

namespace App\Services;


class StringTransformator
{
    public function transformToNativeHomePhoneFormat($phone)
    {
        if ($phone) {
            $nativeFormat = '+';
            for ($i = 0; $i < strlen($phone); $i++) {
                switch ($i) {
                    case 3:
                        $nativeFormat .= ' ('.$phone[$i];
                        break;
                    case 7:
                        $nativeFormat .= ') '.$phone[$i];
                        break;
                    case 8:
                        $nativeFormat .= '-'.$phone[$i];
                        break;
                    case 10:
                        $nativeFormat .= '-'.$phone[$i];
                        break;
                    default:
                        $nativeFormat .= $phone[$i];
                }
            }

            return $nativeFormat;
        }

        return '';
    }

    public function transformToNativePhoneFormat($phone)
    {
        if ($phone) {
            $nativeFormat = '+';
            for ($i = 0; $i < strlen($phone); $i++) {
                switch ($i) {
                    case 3:
                        $nativeFormat .= ' ('.$phone[$i];
                        break;
                    case 5:
                        $nativeFormat .= ') '.$phone[$i];
                        break;
                    case 8:
                        $nativeFormat .= '-'.$phone[$i];
                        break;
                    case 10:
                        $nativeFormat .= '-'.$phone[$i];
                        break;
                    default:
                        $nativeFormat .= $phone[$i];
                }
            }

            return $nativeFormat;
        }

        return '';
    }

    public function clearPhone($phone)
    {
        $clearPhone = '';
        for ($i = 0; $i < strlen($phone); $i++) {
            if ($phone[$i] >= '0' && $phone <= '9') {
                $clearPhone .= $phone[$i];
            }
        }

        return $clearPhone;
    }

    public static function dateToString($date)
    {
        $dateSting = '';
        $dateSting .= date('d ', $date->getTimestamp());
        switch (date('n', $date->getTimestamp())) {
            case 1: {
                $dateSting .= "января";
                break;
            }
            case 2: {
                $dateSting .= "февраля";
                break;
            }
            case 3: {
                $dateSting .= "марта";
                break;
            }
            case 4: {
                $dateSting .= "апреля";
                break;
            }
            case 5: {
                $dateSting .= "мая";
                break;
            }
            case 6: {
                $dateSting .= "июня";
                break;
            }
            case 7: {
                $dateSting .= "июля";
                break;
            }
            case 8: {
                $dateSting .= "августа";
                break;
            }
            case 9: {
                $dateSting .= "сентября";
                break;
            }
            case 10: {
                $dateSting .= "октября";
                break;
            }
            case 11: {
                $dateSting .= "ноября";
                break;
            }
            case 12: {
                $dateSting .= "декабря";
                break;
            }
        }
        $dateSting .= date(' Yг.', $date->getTimestamp());

        return $dateSting;
    }
}