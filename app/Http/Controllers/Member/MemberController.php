<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{




    public function dashboard()
    {
        dd(Auth::guard('member')->user());
        $system = Sysfigs::find(1);
        return view('pages.'.$system->theme.'.back.dashboard')->with(compact('system'));
    }



}
