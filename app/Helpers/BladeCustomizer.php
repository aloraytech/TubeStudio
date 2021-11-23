<?php

namespace App\Helpers;

class BladeCustomizer
{


    public static function duration(string $time)
    {
        $array = explode(':',$time);
        switch (count($array)) {
            case 3:
                $array[0] = $array[0].'h';
                $array[1] = $array[1].'m';
                $array[2] = $array[2].'s';
                break;
            default:
                $array[0] = $array[0].'m';
                $array[1] = $array[1].'s';
        }

        return implode(' ',$array);

    }


}
