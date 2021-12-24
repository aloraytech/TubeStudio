<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class PathCustomizer
{

    private string $pathLocation = 'data/path_config.json';

    public function getPath()
    {
        $paths = Storage::get($this->pathLocation);
        return json_decode($paths,true);
    }


    public function setPath($paths)
    {
        if(is_string($paths))
        {

        }elseif (is_array($paths))
        {
            return Storage::put($this->pathLocation,json_encode($paths));
        }

    }







}
