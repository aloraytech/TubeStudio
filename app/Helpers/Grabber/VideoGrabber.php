<?php

namespace App\Helpers\Grabber;

class VideoGrabber
{

    private string $url='';
    private object|string $helper='';

    public function __construct($url)
    {
        $this->url = $url;
        $this->foundMatch();
    }


    public function resolve()
    {

        return true;
    }


    public function getVideo()
    {
        return $this->helper->getVideo();
    }




    private function foundMatch()
    {
        if(preg_match('/dailymotion/',$this->url,$matches))
        {
            $this->helper = new DailymotionHelper($this->url);
        }elseif (preg_match('/youtube/',$this->url,$matches))
        {
            $this->helper = new YoutubeHelper($this->url);
        }elseif (preg_match('/youtu/',$this->url,$matches))
        {
            $this->helper = new YoutubeHelper($this->url);
        }else{
            $this->helper = '';
        }

        return $this->helper;
    }




}
