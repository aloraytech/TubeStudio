<?php

namespace App\Helpers\Grabber;

use App\Models\Movies\Videos;

class VideoGrabber
{

    private string $url;
    private object $helper;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->foundMatch();
    }

    /**
     * @return bool
     */
    public function resolve()
    {
        if(!empty($this->helper))
        {
            return true;
        }else{
            return false;
        }

    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->helper->getVideo();
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return DailymotionHelper|object|YoutubeHelper
     */
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
            $this->helper = new YoutubeHelper($this->url);
        }

        return $this->helper;
    }


    public function exist()
    {
        if(!empty($this->helper))
        {
            $result = Videos::where('url_path',$this->url)->count();

            if($result)
            {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }


}
