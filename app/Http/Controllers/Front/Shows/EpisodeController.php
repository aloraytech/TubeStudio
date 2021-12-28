<?php

namespace App\Http\Controllers\Front\Shows;

use App\Http\Controllers\Controller;
use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{



    public function getSingle(Shows $shows,Seasons $seasons,Episodes $episodes,Request $request)
    {

//        dd($shows,$seasons,$episodes);

        // Default Data
        $pages = $this->pages;
        $system = $this->systems;

        $shows->load('seasons');
        $seasons->load('episodes','trailers');
        $episodes->load('videos');




        return view('pages.'.$this->themes.'.front.show.details')
            ->with(compact('system','pages'))
            ->with(compact('shows','seasons','episodes'));




    }



}
