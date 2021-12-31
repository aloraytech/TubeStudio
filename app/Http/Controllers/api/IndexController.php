<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Blog\Posts;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use Illuminate\Http\Request;
use Symfony\Component\ErrorHandler\Error\FatalError;

class IndexController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,bool $web=false)
    {

        $slider = $this->getSlider();
        $upcoming = '';
        $trending = '';

        dd($slider);


    }









    private function getPrimaryClass()
    {
        if($this->systems->theme_type === 'tube')
        {
           if($this->systems->show_pack)
           {
               return Shows::class;
           }else{
               if($this->systems->movie_pack)
               {
                   return Movies::class;
               }else{
                   throw new FatalError("OOPS! ADMIN FORGET SOMETHING TODO.. \n No Active Service Found For Render This Page.",503,[],null,false,[]);
               }
           }

        }elseif($this->systems->theme_type === 'blog'){

            if($this->systems->blog_pack)
            {
                return Posts::class;
            }else{
                if($this->systems->movie_pack)
                {
                    return Movies::class;
                }else{
                    throw new FatalError("OOPS! ADMIN FORGET SOMETHING TODO.. \n No Active Service Found For Rendering.",503,[],null,false,[]);
                }
            }

        }else{
            throw new FatalError("OOPS! No Supported Template Found For Rendering..",503,[],null,false,[]);
        }
    }




















    // GET SLIDER CONTENT

    /**
     * @return void|null
     */
    private function getSlider()
    {
        if($this->systems->has_slider)
        {
            if($this->systems->theme_type === 'tube')
            {
                return $this->getTubeSlider();

            }elseif($this->systems->theme_type === 'blog'){
                return $this->getBlogSider();
            }else{
                return null;
            }
        }else{
            return null;
        }


    }

    // TUBE SLIDER
    /**
     * @return void|null
     */
    private function getTubeSlider()
    {
        if($this->systems->show_pack)
        {
            $slider = Shows::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
            $slider = $slider->where('status',true);
            $slider = $slider->where('age_group','!=','18+');
            $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
            if(!empty($slider))
            {
                $slider = $slider->load('seasons.trailers');
                return $slider;
            }


        }elseif($this->systems->show_pack ===false && $this->systems->movie_pack === true){

            $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
            $slider = $slider->where('status',true);
            $slider = $slider->where('age_group','!=','18+');
            $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
            return $slider;
        }else{
            return null;
        }
    }


    // BLOG SLIDER
    /**
     * @return null
     */
    private function getBlogSider()
    {
        if($this->systems->blog_pack)
        {
            $slider = Posts::where('status',true)->latest('created_at')->paginate($this->systems->limit);
            return $slider;
        }else{
            if($this->systems->movie_pack)
            {
                $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                $slider = $slider->where('status',true);
                $slider = $slider->where('age_group','!=','18+');
                $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                return $slider;
            }
            return null;
        }
    }



    // UPCOMING CONTENT






























    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
