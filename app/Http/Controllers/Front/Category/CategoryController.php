<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\BladeCustomizer;
use App\Http\Controllers\Controller;
use App\Models\Blog\Posts;
use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use App\Models\System\Systems;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function moviesOnly()
    {




        // Load System Data
        $system = $this->systems;
        $pages = $this->pages;
        $movies = Movies::where('status',true)->with('categories','videos')->latest('updated_at')->get();
        $category = Category::where(['status'=>true,'type'=>'movie'])->limit($system->per_page)->get();
        //Upcoming

        // Recommended

        return view('pages.'.$system->themes->name.'.front.category.movie_list')->with(compact('system','pages','movies','category'));
    }


    public function showsOnly()
    {

        // Load System Data
        $system = $this->systems;
        $pages = $this->pages;

        $sliders = $this->getSliderContent('show');  // Only Season Count Extra Require
        $category = Category::withCount('shows')->where('type','=','show')->where('status',true)->latest()->orderby('shows_count','desc')->limit(50)->get();



        $favorite = '';
        $upcoming = Category::withCount('shows')->where('type','=','show')->get();
        $upcoming->load('shows')->where('shows.release_on','>',now());

        $suggested = '';

        $allCategoryShows = $category->load('shows');

        $allCategoryShows = $allCategoryShows->forpage($allCategoryShows->count()/$system->limit,5);




        //$shows = Shows::where('status',true)->with('categories','seasons')->latest('updated_at')->paginate($system->limit);


        //Upcoming

        // Recommended

        return view('pages.'.$this->themes.'.front.category.show_list')
            ->with(compact('system','pages'))
                ->with(compact('sliders','category','upcoming','allCategoryShows'));
    }





    public function getCategory(Category $category,Request $request)
    {
        $system = $this->systems; $pages = $this->pages;
    }








    private function getSliderContent($type='')
    {
        if($this->systems->has_slider)
        {
            if($this->systems->theme_type === 'tube')
            {

                if($this->systems->show_pack && $type='show')
                {

                    $slider = Shows::withCount('seasons')->where('release_on','<',now())->where('status',true)->latest('created_at')
                        ->where('age_group','!=','18+')->orderby('seasons_count')->paginate();

                    return $slider;

                }
                if($this->systems->movie_pack === true  && $type='movie'){

                    $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                    $slider = $slider->where('status',true);
                    $slider = $slider->where('age_group','!=','18+');
                    $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                    return $slider;
                }

            }elseif ($this->systems->theme_type === 'blog')
            {

                if($this->systems->blog_pack && $type !='show' || $type !='movie')
                {
                    $slider = Posts::where('status',true)->latest('created_at')->paginate($this->systems->limit);
                    return $slider;
                }else{
                    if($this->systems->movie_pack && $type ='movie')
                    {
                        $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                        $slider = $slider->where('status',true);
                        $slider = $slider->where('age_group','!=','18+');
                        $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                        return $slider;
                    }
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return null;
        }

    }





















}


