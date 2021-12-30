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

    }

    public function dashboard(Request $request)
    {

         if(Auth::guard('member')->check())
         {
             $system = $this->systems;
             $pages = $this->pages;
             $user = Auth::guard('member')->user();

             return view('pages.'.$this->themes.'.back.dashboard')->with(compact('system','pages','user'));
         }else{
             return redirect()->route('landing.index');
         }


    }


    public function library()
    {

    }

    public function watchlist()
    {

    }





}
