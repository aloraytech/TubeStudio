<?php

namespace App\Http\Controllers\Front\Movies;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{


    public function getSingle(Movies $movie,Request $request)
    {



        $movie->load('videos');
        $pages = $this->pages;
        $allMovies = Movies::where('status',true)->latest('updated_at')->get();
        $similars = $allMovies->where('categories_id','=',$movie->categories_id);
        $upcoming = $allMovies->where('release_on','>',now());


        // Load System Data
        $system = $this->systems;

//        dd($movies);
        return view('pages.'.$this->themes.'.front.movie.watch')
            ->with(compact('system','pages','movie','similars','upcoming'));

    }

    public function getAll()
    {

        // Load System Data
        $pages = $this->pages;
        $system = $this->systems;
        $movies = Movies::with('videos','categories')->where('status',true);
        if(!Auth::check())
        {
            $upcoming = $movies->where('age_group','!=','18+');
        }

        //$sliders = $this->getSliders();

        $sliders = Movies::with('videos')->where('status',true)->latest()->paginate();

        $popular = $movies->latest('updated_at')->orderby('views')->paginate($this->systems->limit);  // Ok Tested.. ALl Like it

        $upcoming = $movies->latest('updated_at')->where('release_on','>',now())->orderby('views')->paginate();


        $suggestions = $popular;
        $suggestions = $suggestions->reverse();





//        if(!Auth::check())
//        {
//            $upcoming = $upcoming->where('age_group','!=','18+');
//        }
//        $upcoming->forpage($upcoming->count()/$this->systems->limit,$this->systems->limit);

        //dd($popular,$upcoming);



        $category = Category::where('type','movie')->where('status',true)->orderBy('updated_at')->get();





        return view('pages.'.$this->themes.'.front.movie.all')
            ->with(compact('system','pages'))
            ->with(compact('system','sliders','popular','upcoming','suggestions'))
            ->with(compact('system','category'));
    }


}
