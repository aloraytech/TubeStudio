<?php

namespace App\Http\Controllers\Front\Shows;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->with(compact('system','pages','shows','allSeasons','seasonEpisode','firstSeasonDetail','totalEpisodesCount','seasons'));

    }



    public function getAllContent()
    {

        // Load System Data
        $pages = $this->pages;
        $system = $this->systems;
        $shows = Shows::withCount('seasons')->where('status',true)->with('seasons');
        if(!Auth::check())
        {
            $upcoming = $shows->where('age_group','!=','18+');
        }

        //$sliders = $this->getSliders();

        $sliders = Shows::withCount('seasons')->with('oldestSeasons')->where('status',true)->latest()->paginate();

        $popular = $shows->latest('updated_at')->orderby('views')->paginate($this->systems->limit);  // Ok Tested.. ALl Like it

        $upcoming = $shows->latest('updated_at')->where('release_on','>',now())->orderby('views')->paginate($this->systems->limit);

        $suggestions = $popular;
        $suggestions = $suggestions->reverse();




//        if(!Auth::check())
//        {
//            $upcoming = $upcoming->where('age_group','!=','18+');
//        }
//        $upcoming->forpage($upcoming->count()/$this->systems->limit,$this->systems->limit);

      //dd($popular,$upcoming);

        $firstCatShow = null;
        $secondCatShow = null;
        $thirdCatShow = null;


        $category = Category::where('type','show')->where('status',true)->orderBy('updated_at')->get();





        return view('pages.'.$this->themes.'.front.show.all')
            ->with(compact('system','pages','shows'))
            ->with(compact('system','sliders','popular','upcoming','suggestions'))
            ->with(compact('system','category'));
    }


    private function getCatShow(int $id)
    {
        $result = null;
        $result = Shows::where('status',true)->where('release_on','<',now())->where('categories_id',$id)->paginate();
        return $result;
    }





    public function getSingleShow()
    {

    }


    private function getSliders()
    {
        $slider = Shows::with(['seasons' => function ($query) {$query->oldest()->first();}])
            ->withCount('seasons')->where('status',true)->where('release_on','<',now())
            ->latest('created_at')
            ->orderby('seasons_count')->limit($this->systems->limit*5)->get();


        if(!Auth::check())
        {
            $slider = $slider->where('age_group','!=','18+');
        }
        $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
        return $slider;
    }





}
