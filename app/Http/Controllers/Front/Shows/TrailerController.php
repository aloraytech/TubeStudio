<?php

namespace App\Http\Controllers\Front\Shows;

use App\Http\Controllers\Controller;
use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use App\Models\Shows\Trailers;
use Illuminate\Http\Request;

class TrailerController extends Controller
{
    public function getSingle(Trailers $trailer,Request $request)
    {

//        dd($shows,$seasons,$episodes);

        // Default Data
        $pages = $this->pages;
        $system = $this->systems;

        $seasons = Seasons::find($trailer->seasons_id);


        $shows = Shows::find($seasons->shows_id);
        $shows->load('seasons');
        $seasons->load('episodes','trailers');
        $trailer->load('videos');




        return view('pages.'.$this->themes.'.front.show.trailer')
            ->with(compact('system','pages'))
            ->with(compact('shows','seasons','trailer'));




    }
}
