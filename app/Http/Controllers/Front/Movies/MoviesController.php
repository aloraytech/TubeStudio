<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Models\Movies\Movies;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;

class MoviesController extends Controller
{


    public function getSingle(Movies $movies,Request $request)
    {

        $movies->load('videos');

        $allMovies = Movies::where('status',true)->latest('updated_at')->get();
        $similars = $allMovies->where('categories_id','=',$movies->categories_id);
        $upcoming = $allMovies->where('release_on','>',now());


        // Load System Data
        $system = $this->systems;

//        dd($movies);
        return view('pages.'.$system->themes->name.'.front.movie.watch')->with(compact('system','movies','similars','upcoming'));

    }

    public function getAll()
    {
        // Load System Data
        $system = $this->systems;
    }


}
