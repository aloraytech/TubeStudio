<?php

namespace App\Http\Controllers\Front;

use App\Helpers\YoutubeHelper;
use App\Http\Controllers\Controller;
use App\Models\Movies\Movies;
use App\Models\Shows\Shows;
use App\Models\System\Sysfigs;
use App\Models\Users\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{


    public function index()
    {
        $system = Sysfigs::where('id',1)->first();
        $activities = Activities::where('members_id',1)->with('movies','shows')->get();
        $shows = Shows::with('seasons','categories','videos')->latest('id')->orderBy('views')->paginate($system->per_page);
        $movies = Movies::with('categories','videos')->latest('id')->orderBy('views')->paginate($system->per_page);



        if($system->installed)
        {
            if($system->coming_soon)
            {
                return view('optional.coming.soon')->with(compact('system'));
            }else{
                return view('pages.'.$system->theme.'.front.index')->with(compact('shows','system','activities','movies'));
            }
        }else{
            return view('optional.setup.installer')->with(compact('system'));
        }




    }

}
