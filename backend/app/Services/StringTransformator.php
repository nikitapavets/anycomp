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
}