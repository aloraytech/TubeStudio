<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{


    public function getIndex(Request $request)
    {
        $api = new \App\Http\Controllers\api\IndexController();
        $content = $api->index($request,true);
        dd($content);
    }









    // Class End
}
