<?php

namespace App\Http\Controllers\Front;

use App\Helpers\YoutubeHelper;
use App\Http\Controllers\Controller;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\Business\Adverts;
use App\Models\System\Sysfigs;
use App\Models\System\Systems;
use App\Models\User;
use App\Models\System\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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


        // Load System Data
        $system = Systems::find(1);

        $ads = Adverts::where('status',true)->get();

        // Load Shows With Episodes
        $allShows = Shows::with('seasons','seasons.episodes','seasons.trailers','categories','videos')->latest('updated_at')->orderBy('views','desc')->where('status',true)->get();

        $allMovies = Movies::with('videos')->latest('updated_at')->orderBy('views','desc')->where('status',true)->get();






        // Load Advertisement








        // Customize Data And Fill in Variables
        $topViewMovie = $allMovies->firstWhere('views','=',$allMovies->max('views'));
        $topViewShow = $allShows->firstWhere('views','=',$allShows->max('views'));
        // Default Variables
        $shows = $allShows->forPage($allShows->count()/$system->per_page,$system->per_page);
        $movies = $allMovies->forPage($allMovies->count()/$system->per_page,$system->per_page);



        $collection = collect([$allMovies->where('release_on','>',now()),$allShows->where('release_on','>',now())]);

        $upcoming = [
            'content' => $collection->random(),
            'has' => ($allMovies->where('release_on','>',now())->count() ?? $allShows->where('release_on','>',now())->count()) > 0,
        ];






        // Check User, Whether User/Admin/Member/Subscriber
        if($user['exist'])
        {
            // Load User Activities
            $activities = Activities::where('members_id',$user['id'])->with('movies','shows')->get();
        }


        // Check System Installed Properly Or Not
        if($system->installed)
        {
            // If Admin Or Tech Team Display A Coming Soon Page
            if($system->coming_soon)
            {
                // Display Coming Soon Page
                return view('optional.coming.soon')->with(compact('system'));
            }else{
                // Generate Result And Display To Your Client
                return view('pages.'.$system->theme.'.front.index')->with(compact('shows','system','activities','movies','user','ads','topViewMovie','topViewShow','upcoming'));
            }
        }else{
            // Run Installer
            return view('optional.setup.installer')->with(compact('system'));
        }




    }













}
