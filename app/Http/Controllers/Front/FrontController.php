<?php

namespace App\Http\Controllers\Front;

use App\Helpers\YoutubeHelper;
use App\Http\Controllers\Controller;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\System\Adverts;
use App\Models\System\Sysfigs;
use App\Models\Users\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{


    public function index()
    {
        // Check MemberLogin or Not
        $user = [
            'exist' => false, // if guest
            'type' => 'role of member',
            'id' => '',
        ];
        $activities = [];
        $system = Sysfigs::where('id',1)->first();
        $ads = Adverts::where('status',true)->get();
        $allShows = Shows::with('seasons','seasons.episodes','categories','videos')->latest('updated_at')->orderBy('views','desc')->where('status',true)->get();
        $allMovies = Movies::with('categories','videos')->latest('updated_at')->orderBy('views','desc')->where('status',true)->get();






        $topViewMovie = $allMovies->firstWhere('views','=',$allMovies->max('views'));
        $topViewShow = $allShows->firstWhere('views','=',$allShows->max('views'));
        $upcomingMovies = $allMovies->where('release_on','>',now())->forPage($allMovies->count()/$system->per_page,$system->per_page);
        $upcomingShows = $allShows->where('release_on','>',now())->forPage($allShows->count()/$system->per_page,$system->per_page);

        $shows = $allShows->forPage($allShows->count()/$system->per_page,$system->per_page);
        $movies = $allMovies->forPage($allMovies->count()/$system->per_page,$system->per_page);




        if($user['exist'])
        {
            $activities = Activities::where('members_id',$user['id'])->with('movies','shows')->get();
        }



        if($system->installed)
        {
            if($system->coming_soon)
            {
                return view('optional.coming.soon')->with(compact('system'));
            }else{
                return view('pages.'.$system->theme.'.front.index')->with(compact('shows','system','activities','movies','user','ads','topViewMovie','topViewShow'));
            }
        }else{
            return view('optional.setup.installer')->with(compact('system'));
        }




    }

}
