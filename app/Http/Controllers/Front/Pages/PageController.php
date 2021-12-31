<?php

namespace App\Http\Controllers\Front\Pages;

use App\Http\Controllers\Controller;
use App\Models\Blog\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{


    public function view(Request $request)
    {
        $system = $this->systems;
        $pages = $this->pages;
        $url = str_replace('/','',$request->getPathInfo());
        $pageData = $pages->where('url','pages.'.str_replace('-','.',$url))->first();
        return view('pages.'.$this->themes.'.front.pages.single')->with(compact('system','pages','pageData'));




    }









}
