<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\BladeCustomizer;
use App\Helpers\PathCustomizer;
use App\Http\Controllers\Controller;
use App\Models\Blog\Posts;
use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use App\Models\System\Systems;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
      public function moviesOnly()
    {

        if($this->systems->movie_pack)
        {
            // Load System Data
            $system = $this->systems;
            $pages = $this->pages;

            $mm = Movies::with('categories','videos')->find(1);







            $sliders = $this->getSliderContent('movie');  // Only Season Count Extra Require
            $category = Category::withCount('movies')->where('type','=','movie')
                ->where('status',true)->latest()->orderby('movies_count','desc')->limit(50)->get();


            if(Auth::check())
            {
                $category = $category->load('movies');
            }else{
                $category = $category->load('movies')->where('movies.age_group','!=','18+');
            }

            $favorite = '';
            $upcoming = $category;
            $upcoming->where('movies.release_on','>',now());









            $suggested = '';

            $allCategoryMovies = $category;

            $allCategoryMovies = $allCategoryMovies->forpage($allCategoryMovies->count()/$system->limit,5);


            //Upcoming

            // Recommended

            return view('pages.'.$this->themes.'.front.category.movie_list')
                ->with(compact('system','pages'))
                ->with(compact('sliders','category','upcoming','allCategoryMovies'));
        }else{
            return redirect(route('landing.index'));
        }
    }


    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function showsOnly()
    {

        if($this->systems->show_pack)
        {

            // Load Default Data
            $system = $this->systems;
            $pages = $this->pages;
            // Load Page Data
            $sliders = $this->getSliderContent('show');



//            $sliders = Shows::with(['seasons' => function ($query) {$query->oldest()->first();}])
//                ->withCount('seasons')->where('status',true)->get();
//
//
//            dd($sliders);



//            $sliders = with(['episodes' => function ($query) {$query->oldest()->first();}])
//                ->where('shows_id',$shows->id)->oldest()->first();
            // Load Category With Shows And Shows Count
            $category = Category::withCount('shows')->where('type','=','show')
                ->where('status',true)->latest()->orderby('shows_count','desc')->limit($this->systems->limit * 4)->get();
            $category = $category->load('shows','shows.seasons');
            if(!Auth::check())
            {
                $category = $category->where('shows.age_group','!=','18+');
            }

            // Load Page According Data
            $favorite = '';
            $upcoming = $category;
            $upcoming->where('shows.release_on','>',now());
            $upcoming = $upcoming->forpage($upcoming->count()/$system->limit,$system->limit);

            // Suggestion Show
            $suggested = '';
            // Page Show Data
            $allCategoryShows = $category;
            $allCategoryShows = $allCategoryShows->forpage($allCategoryShows->count()/$system->limit,$system->limit);
            // Send View
            return view('pages.'.$this->themes.'.front.category.show_list')
                ->with(compact('system','pages'))
                ->with(compact('sliders','category','upcoming','allCategoryShows'));
        }else{
            return redirect(route('landing.index'));
        }
    }

    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function blogsOnly()
    {

       if($this->systems->blog_pack)
       {
           // Load System Data
           $system = $this->systems;
           $pages = $this->pages;

           $sliders = $this->getSliderContent('blog');  // Only Season Count Extra Require
           $category = Category::withCount('posts')->where('type','=','post')->where('status',true)->latest()->orderby('posts_count','desc')->limit(50)->get();

           if(Auth::check())
           {
               $category = $category->load('posts');
           }else{
               $category = $category->load('posts')->where('posts.age_group','!=','18+');
           }

           $favorite = '';
           $upcoming = $category;
           $upcoming->where('posts.release_on','>',now());

           $suggested = '';

           $allCategoryPosts = $category;

           $allCategoryPosts = $allCategoryPosts->forpage($allCategoryPosts->count()/$system->limit,5);




           //$shows = Shows::where('status',true)->with('categories','seasons')->latest('updated_at')->paginate($system->limit);


           //Upcoming

           // Recommended

           return view('pages.'.$this->themes.'.front.category.blog_list')
               ->with(compact('system','pages'))
               ->with(compact('sliders','category','upcoming','allCategoryPosts'));
       }else{
           return redirect(route('landing.index'));
       }
    }


    /**
     * @param Category $category
     * @param Request $request
     */
    public function getCategory(Category $category,Request $request)
    {
        $system = $this->systems; $pages = $this->pages;

        if($category->type ==='show')
        {
            $category->load('shows');
        }elseif ($category->type === 'movie')
        {
            $category->load('movies');
        }elseif($category->type === 'blog'){
            $category->load('posts');
        }


        dd($category);



    }
















    /**
     * @param string $type
     * @return void|null
     */
    private function getSliderContent($type='')
    {

        if($this->systems->has_slider)
        {

            if( $type==='show')
            {
                if($this->systems->show_pack)
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

            if($type === 'movie')
            {
                if($this->systems->movie_pack){

                    $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                    $slider = $slider->where('status',true);

                    if(!Auth::check())
                    {
                        $slider = $slider->where('age_group','!=','18+');
                    }

                    $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                    return $slider;
                }
            }

            if($type === 'blog')
            {
                if($this->systems->blog_pack)
                {
                    $slider = Posts::where('status',true)->latest('created_at')->limit($this->systems->limit*5)->get();
                    if(!Auth::check())
                    {
                        $slider = $slider->where('age_group','!=','18+');
                    }
                    $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                    return $slider;
                }
            }
        }else{
            return null;
        }

    }





















}


