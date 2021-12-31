<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Posts;
use App\Models\Category\Category;
use App\Models\Movies\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function getSingle(Posts $posts, Request $request)
    {
        $similars = null;
        if(!empty($posts->id))
        {
            // Load System Data
            $pages = $this->pages;
            $system = $this->systems;
            $posts->load('categories');
            $similars = Posts::where('categories_id',$posts->categories_id)->where('status',true)->latest()->paginate();
            return view('pages.'.$this->themes.'.front.blog.single')->with(compact('system','pages','posts','similars'));
        }else{
            return redirect()->route('blog.page');
        }


    }


    public function getAll(Request $request)
    {
        // Load System Data
        $pages = $this->pages;
        $system = $this->systems;
        $posts = Posts::with('categories')->where('status',true);
        if(!Auth::check())
        {
            $upcoming = $posts->where('age_group','!=','18+');
        }

        //$sliders = $this->getSliders();

        $sliders = Posts::with('categories')->where('release_on','<',now())->where('status',true)->latest()->paginate($this->systems->limit);

        $popular = $posts->latest('updated_at')->orderby('views')->paginate($this->systems->limit);  // Ok Tested.. ALl Like it

        $upcoming = $posts->latest('updated_at')->where('release_on','>',now())->orderby('views')->paginate();


        $suggestions = $popular;
//        $suggestions = $suggestions->reverse();


        $allPosts = $sliders;





//        if(!Auth::check())
//        {
//            $upcoming = $upcoming->where('age_group','!=','18+');
//        }
//        $upcoming->forpage($upcoming->count()/$this->systems->limit,$this->systems->limit);

        //dd($popular,$upcoming);



        $category = Category::where('type','blog')->where('status',true)->orderBy('updated_at')->get();





        return view('pages.'.$this->themes.'.front.blog.list')
            ->with(compact('system','pages'))
            ->with(compact('system','sliders','popular','upcoming','suggestions'))
            ->with(compact('system','category','allPosts'));

    }


}
