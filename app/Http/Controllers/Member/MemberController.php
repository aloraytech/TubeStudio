<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

use App\Models\System\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function dashboard(Request $request)
    {

     //   dd(Auth::guard('member')->user());
        $system = $this->systems;
        $pages = $this->pages;
        $user = Auth::guard('member')->user();

        return view('pages.'.$system->themes->name.'.back.dashboard')->with(compact('system','pages','user'));
    }


    public function library()
    {

    }

    public function watchlist()
    {

    }





}
