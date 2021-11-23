<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\BladeCustomizer;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function moviesOnly()
    {




        // Load System Data
        $system = Sysfigs::find(1);
        $movies = Movies::where('status',true)->with('categories','videos')->latest('updated_at')->get();
        $category = Category::where(['status'=>true,'type'=>'movie'])->limit($system->per_page)->get();
        //Upcoming

        // Recommended

        return view('pages.'.$system->theme.'.front.category.movie_list')->with(compact('system','movies','category'));
    }


    public function showsOnly()
    {

        // Load System Data
        $system = Sysfigs::find(1);
        $shows = Shows::where('status',true)->with('categories','seasons')->latest('updated_at')->get();
        $category = Category::where(['status'=>true,'type'=>'show'])->limit($system->per_page)->get();

        //Upcoming

        // Recommended

        return view('pages.'.$system->theme.'.front.category.show_list')->with(compact('system','shows','category'));
    }
}
