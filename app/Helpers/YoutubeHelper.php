<?php

namespace App\Helpers;

class YoutubeHelper
{



    public function analyze(string $link='')
    {

        $youtube = "https://www.youtube.com/oembed?url=". $link ."&format=json";
        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        // Prepare Embed Code
        if (preg_match('`src="?([^"\s]+)"?[^>]*\>`',$result['html'],$matches)){
            $result['html'] = $matches[1];
        }
        return json_decode(json_encode($result), true);
    }



}
