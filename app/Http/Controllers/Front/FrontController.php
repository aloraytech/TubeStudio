<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Customizer\PathCustomizer;
use App\Helpers\IPResolver;
use App\Helpers\YoutubeHelper;
use App\Http\Controllers\api\IndexController;
use App\Http\Controllers\Controller;
use App\Models\Blog\Posts;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\Business\Adverts;
use App\Models\System\Stats;
use App\Models\System\Sysfigs;
use App\Models\System\Systems;
use App\Models\User;
use App\Models\System\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

    private object|array $default_Latest=[];
    private object|array $default_Popular=[];
    private object|array $default_Upcoming=[];


    public function index(Request $request)
    {

        $system = $this->systems;
        $pages = $this->pages;
        $user = [
            'exist' => Auth::check(),
        ];


        if($this->systems->installed)
        {
            // If Admin Or Tech Team Display A Coming Soon Page
            if(!$this->systems->coming_soon)
            {
                // Execute Data
                $content = [
                    'slider' => false,
                    'favourite'=>false,
                    'upcoming' => false,
                    'topten'=> false,
                    'suggested' => false,
                    'single' => false,
                    'trending' => false,
                    'popular' => false,
                ];

                //Content Data
                $sliders = $this->getSliderContent();
                if($sliders !=null){$content['slider'] = true;}


            //    $favourites = $this->getFavouriteContent(); // stats
//                if($favourites !=null){$content['favourite'] = true;}
                $upcomings = $this->getUpcomingContent();
                if($upcomings !=null){$content['upcoming'] = true;}
              //  $topTen = $this->getTopTenContent();  // stats loading
//                $suggested = $this->getSuggestedContent();
//                $single = $this->getSingleContent();
                $trending = $this->getTrendingContent();
                if($trending !=null){$content['trending'] = true;}
//                $popular = $this->getPopularCategoryContent();



                $content = json_decode(json_encode($content));

             //   dd('Slider :',$sliders,'Upcoming :',$upcomings,'Trainding :', $trending);

                // Generate Result And Display To Your Client
                return view('pages.'.$this->themes.'.front.index')
                    ->with(compact('system','pages','content','user'))
                    ->with(compact('sliders','upcomings','trending'));
                    //->with(compact('shows','system','activities','movies','user','ads','topViewMovie','topViewShow','upcoming','pages'));

            }else{
                // Display Coming Soon Page
                return view('optional.coming.soon')->with(compact('system','pages'));
            }
        }else{

            // Run Installer
            return view('optional.setup.installer')->with(compact('system','pages'));
        }





    }


    /**
     * @return mixed|void
     */
    private function getSliderContent()
    {
        if($this->systems->has_slider)
        {
            if($this->systems->theme_type === 'tube')
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

                    }

                    return $slider;

                }elseif($this->systems->show_pack ===false && $this->systems->movie_pack === true){

                    $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                    $slider = $slider->where('status',true);
                    $slider = $slider->where('age_group','!=','18+');
                    $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                    return $slider;
                }

            }elseif ($this->systems->theme_type === 'blog')
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
            }else{
                return null;
            }
        }else{
            return null;
        }

    }

    private function getFavouriteContent()
    {
        return Stats::with('movies','shows','posts')->where('members_id',Auth::guard('member')->id())
            ->latest('favourite')->limit($this->systems->limit)->get();
    }


    private function getUpcomingContent()
    {
        if($this->systems->has_upcoming)
        {
            if($this->systems->theme_type === 'tube')
            {
                if($this->systems->show_pack)
                {

                    $upcoming = Shows::where('release_on','>',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                    $upcoming = $upcoming->where('status',true);
                    $upcoming = $upcoming->where('age_group','!=','18+');
                    $upcoming = $upcoming->forpage($upcoming->count()/$this->systems->limit,$this->systems->limit);
                    if(!empty($upcoming))
                    {
                        $upcoming = $upcoming->load('seasons');
                    }

                    return $upcoming;

                }elseif($this->systems->show_pack ===false && $this->systems->movie_pack === true){

                    $upcoming = Movies::where('release_on','>',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                    $upcoming = $upcoming->where('status',true);
                    $upcoming = $upcoming->where('age_group','!=','18+');
                    $upcoming = $upcoming->forpage($upcoming->count()/$this->systems->limit,$this->systems->limit);
                    return $upcoming;
                }

            }elseif ($this->systems->theme_type === 'blog')
            {

                if($this->systems->blog_pack)
                {
                    $upcoming = Posts::where('status',true)->latest('created_at')->paginate($this->systems->limit);
                    return $upcoming;
                }else{
                    if($this->systems->movie_pack)
                    {
                        $upcoming = Movies::where('release_on','>',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                        $upcoming = $upcoming->where('status',true);
                        $upcoming = $upcoming->where('age_group','!=','18+');
                        $upcoming = $upcoming->forpage($upcoming->count()/$this->systems->limit,$this->systems->limit);
                        return $upcoming;
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




    private function getTopTenContent()
    {
        if($this->systems->theme_type === 'tube')
        {
            if($this->systems->show_pack)
            {

                $slider = Shows::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                $slider = $slider->where('status',true);
                $slider = $slider->where('age_group','!=','18+');
                $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                if(!empty($slider))
                {
                    $slider = $slider->load('seasons');
                }

                return $slider;

            }elseif($this->systems->show_pack ===false && $this->systems->movie_pack === true){

                $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                $slider = $slider->where('status',true);
                $slider = $slider->where('age_group','!=','18+');
                $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                return $slider;
            }

        }elseif ($this->systems->theme_type === 'blog')
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
        }else{
            return null;
        }
    }




    private function getSuggestedContent()
    {
        return $this->getDefaultMostViewed();
    }


    private function getSingleContent(){}

    /**
     * @return void|null
     */
    private function getTrendingContent()
    {
        if($this->systems->has_slider)
        {
            if($this->systems->theme_type === 'tube')
            {
                if($this->systems->show_pack)
                {
                    $slider = Shows::withCount('seasons')->orderBy('seasons_count', 'desc')->limit($this->systems->limit*5)->get();
                    $slider = $slider->where('release_on','<',now())->sortby('created_at');
                    $slider = $slider->where('status',true);
                    $slider = $slider->where('age_group','!=','18+');
                    $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                    if(!empty($slider))
                    {
                        $slider = $slider->load('categories','seasons','seasons.trailers','seasons.episodes');


                    }

                    return $slider;

                }elseif($this->systems->show_pack ===false && $this->systems->movie_pack === true){

                    $slider = Movies::where('release_on','<',now())->latest('created_at')->limit($this->systems->limit*5)->get();
                    $slider = $slider->where('status',true);
                    $slider = $slider->where('age_group','!=','18+');
                    $slider = $slider->forpage($slider->count()/$this->systems->limit,$this->systems->limit);
                    return $slider;
                }

            }elseif ($this->systems->theme_type === 'blog')
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
            }else{
                return null;
            }
        }else{
            return null;
        }
    }


    private function getPopularCategoryContent(){}









}
