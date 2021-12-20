<?php

namespace App\Support;

class Helper
{
    /**
    * Swap point for comma and comma for point
    *
    * @return string
    */
    public static function numberFormat($number) {

        $number = str_replace('.', '¿?', $number);
        $number = str_replace(',', '.', $number);
        $number = str_replace('¿?', ',', $number);

        return $number;
    }
}
