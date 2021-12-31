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

    public static function tags($tags_list)
    {

        if(!empty($tags_list))
        {
            if(is_string($tags_list))
            {
                if(Str::match(',',$tags_list))
                {
                    $array = explode(',',$tags_list);
                    return self::getTagsFromArray($array);
                }elseif (Str::match(',',$tags_list))
                {
                    $array = explode(';',$tags_list);
                    return self::getTagsFromArray($array);
                }
            }elseif (is_array($tags_list))
            {
                return self::getTagsFromArray($tags_list);
            }
        }else{
            echo '';
        }
    }


    private static function getTagsFromArray(array $tags)
    {
        $tag_line = '';
        foreach ($tags as $key => $value) {
            $tag_line .= ' <a href="#" class="text-white"> ' . ucfirst($value) . ' </a>&nbsp;';
        }
            echo $tag_line;
    }




















}
