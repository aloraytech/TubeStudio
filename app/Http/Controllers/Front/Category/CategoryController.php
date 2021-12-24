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

          $sliders = $this->getSliderContent('movie');  // Only Season Count Extra Require

          $category = Category::withCount('movies')->where('type','=','movie')->where('status',true)->latest()->orderby('movies_count','desc')->limit(50)->get();



          $favorite = '';
          $upcoming = Category::withCount('movies')->where('type','=','movie')->get();
          $upcoming->load('movies')->where('shows.release_on','>',now());

          $suggested = '';

          $allCategoryMovies = $category->load('movies');

          $allCategoryMovies = $allCategoryMovies->forpage($allCategoryMovies->count()/$system->limit,5);




          //$shows = Shows::where('status',true)->with('categories','seasons')->latest('updated_at')->paginate($system->limit);


          //Upcoming

          // Recommended

          return view('pages.'.$this->themes.'.front.category.movie_list')
              ->with(compact('system','pages'))
              ->with(compact('sliders','category','upcoming','allCategoryMovies'));
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


    public function blogsOnly()
    {

        // Load System Data
        $system = $this->systems;
        $pages = $this->pages;

        $sliders = $this->getSliderContent('blog');  // Only Season Count Extra Require
        $category = Category::withCount('blogs')->where('type','=','blog')->where('status',true)->latest()->orderby('blogs_count','desc')->limit(50)->get();



        $favorite = '';
        $upcoming = Category::withCount('blogs')->where('type','=','blog')->get();
        $upcoming->load('blogs')->where('blogs.release_on','>',now());

        $suggested = '';

        $allCategoryShows = $category->load('blogs');

        $allCategoryShows = $allCategoryShows->forpage($allCategoryShows->count()/$system->limit,5);




        //$shows = Shows::where('status',true)->with('categories','seasons')->latest('updated_at')->paginate($system->limit);


        //Upcoming

        // Recommended

        return view('pages.'.$this->themes.'.front.category.blog_list')
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

                if( $type==='show')
                {
                    if($this->systems->show_pack)
                    {

                        $slider = Shows::withCount('seasons')->where('release_on','<',now())->where('status',true)->latest('created_at')
                            ->where('age_group','!=','18+')->orderby('seasons_count')->paginate();

                        return $slider;

                    }
                }

                if($type === 'movie')
                {
                    if($this->systems->movie_pack){

                        $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                        $slider = $slider->where('status',true);
                        $slider = $slider->where('age_group','!=','18+');
                        $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                        return $slider;
                    }
                }

                if($type === 'blog')
                {
                    if($this->systems->blog_pack)
                    {
                        return Posts::where('status',true)->latest('created_at')->paginate($this->systems->limit);
                    }
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


