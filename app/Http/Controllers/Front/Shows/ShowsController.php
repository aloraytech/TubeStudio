<?php

namespace App\Http\Controllers\Front\Shows;

use App\Http\Controllers\Controller;
use App\Models\Category\Tags;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;

class ShowsController extends Controller
{
    public function getSingle(Shows $shows,Seasons $seasons,Request $request)
    {


        // Default Data
        $pages = $this->pages;
        $system = $this->systems;


        if(empty($seasons->id)){
            $firstSeason = Seasons::with(['episodes' => function ($query) {$query->oldest()->first();}])
                ->where('shows_id',$shows->id)->oldest()->first();
            $firstSeasonDetail = Seasons::with('episodes','trailers')->where('id',$firstSeason->id)->get();
        }else{
            $firstSeason = $seasons->load('episodes','trailers');
            $firstSeasonDetail = Seasons::with('episodes','trailers')->where('id',$firstSeason->id)->get();
        }


        $seasonEpisode = $firstSeason;
        //$seasonTrailer = $firstSeason::with(['trailers' => function ($query) {$query->orderBy('created_at')->first();}])->orderBy('created_at')->first();

        $allSeasons = $shows->load('seasons','seasons.episodes');
        $totalEpisodesCount = 0;
        foreach ($allSeasons->seasons as $ses)
        {
            $totalEpisodesCount +=$ses->episodes->count();
        }


//        dd($firstSeasonDetail);



  // dd($seasonEpisode,$firstSeasonDetail,$allSeasons);




        return view('pages.'.$this->themes.'.front.show.single')
            ->with(compact('system','pages','shows','allSeasons','seasonEpisode','firstSeasonDetail','totalEpisodesCount'));

    }



    public function getAll()
    {
        echo "Hello";
        // Load System Data
        $pages = $this->pages;
        $system = $this->systems;
        $movies = Shows::where('status',true)->with('categories','videos')->latest('updated_at')->get();

        return view('pages.'.$system->themes->name.'.front.category.movie_list')->with(compact('system','pages','movies'));
    }

}
