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
        $activities = Activities::where('members_id',1)->with('movies','shows')->paginate($system->per_page);
        $shows = Shows::with('seasons','categories','videos')->paginate($system->per_page);
        $movies = Movies::with('categories','videos')->paginate($system->per_page);

        return view('pages.front.index')->with(compact('shows','system','activities','movies'));


    }

}
