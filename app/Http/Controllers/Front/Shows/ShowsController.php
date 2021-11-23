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



        $allMovies = Shows::where('status',true)->latest('updated_at')->get();
        $similars = $allMovies->where('categories_id','=',$shows->categories_id);
        $upcoming = $allMovies->where('release_on','>',now());


        // Load System Data
        $system = Sysfigs::find(1);

//        dd($movies);
        return view('pages.'.$system->theme.'.front.show.watch')->with(compact('system','shows','similars','upcoming'));

    }



    public function getAll()
    {
        echo "Hello";
        // Load System Data
        $system = Sysfigs::find(1);
        $movies = Shows::where('status',true)->with('categories','videos')->latest('updated_at')->get();

        return view('pages.'.$system->theme.'.front.category.movie_list')->with(compact('system','movies'));
    }

}
