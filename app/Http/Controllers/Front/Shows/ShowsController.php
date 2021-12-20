<?php

namespace App\Http\Controllers\Front\Shows;

use App\Http\Controllers\Controller;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;

class ShowsController extends Controller
{
    public function getSingle(Shows $shows,Request $request)
    {

        $shows->load('seasons','seasons.episodes','seasons.trailers','categories');

        $pages = $this->pages;
        $system = $this->systems;

        $allMovies = Shows::where('status',true)->latest('updated_at')->get();
        $similars = $allMovies->where('categories_id','=',$shows->categories_id);
        $upcoming = $allMovies->where('release_on','>',now());


//        dd($movies);
        return view('pages.'.$system->theme.'.front.show.watch')->with(compact('system','pages','shows','similars','upcoming'));

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
