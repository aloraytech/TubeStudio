<?php

namespace App\Helpers;

use Illuminate\Support\Str;

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


    public static function header_maker(string $header_list)
    {

        $allHeaders = explode(';',$header_list);

        foreach ($allHeaders as $key => $header)
        {

//            if(Str::match('/js/',$header))
//            {
//                echo '<script src="'.$header.'"></script>' , PHP_EOL ."    ";
//            }elseif (Str::match('/css/',$header))
//            {
//                echo '<link rel="stylesheet" href="'.$header.'"/>' , PHP_EOL ."    ";
//            }else{
//                echo '<meta name="description_'.$key.'" content="'.$header.'">' , PHP_EOL ."    ";
//            }

            echo $header, PHP_EOL ."    ";

        }



    }





    public static function description(string $content,int $limit=60)
    {
        return str_replace('<p>','',str_replace('</p>','',Str::limit($content,$limit,'...')));
    }























}
