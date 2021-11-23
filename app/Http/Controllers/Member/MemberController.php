<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function login()
    {
        $system = Sysfigs::find(1);
        return view('pages.'.$system->theme.'.front.user.auth.login')->with(compact('system'));

    }

    public function register()
    {
        $system = Sysfigs::find(1);
        return view('pages.'.$system->theme.'.front.user.auth.registration')->with(compact('system'));

    }



}
