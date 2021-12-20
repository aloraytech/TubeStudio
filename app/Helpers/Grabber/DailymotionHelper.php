<?php

namespace App\Helpers\Grabber;

class DailymotionHelper
{


    public function __construct($url)
    {
        $this->url = $url;
    }



    public function getVideo()
    {
        return $this->analyze();
    }



    public function analyze()
    {

       $result = 'Not Found';
        return json_decode(json_encode($result), true);
    }




}
