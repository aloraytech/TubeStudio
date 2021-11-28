<?php

namespace App\Helpers\Grabber;

class YoutubeHelper
{


    private string $url ='';
    private array $rawData=[];

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getVideo()
    {
        $this->rawData = $this->analyze();
        return $this->filterdData($this->rawData);
    }




    public function analyze()
    {

        $youtube = "https://www.youtube.com/oembed?url=". $this->url ."&format=json";
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

    private function filterdData($rawData)
    {


        return [
                  "title" => $rawData['title'],
                  "author" => $rawData['author_url'],
                  "channel" => $rawData['author_name'],
                  "height" => $rawData['height'],
                  "width" => $rawData['width'],
                  "provider" => $rawData['provider_name'],
                  "thumb_h" => $rawData['thumbnail_height'],
                  "thumb_w" => $rawData['thumbnail_width'],
                  "thumb_url" => $rawData['thumbnail_url'],
                  "code" => $rawData['html'],
        ];

    }


}
