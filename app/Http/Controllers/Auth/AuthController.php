<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;


class AuthController extends Controller
{



    public function login(Request $request)
    {
        $system = Sysfigs::find(1);
        $error='';
        return view('pages.'.$system->theme.'.front.member.auth.login')->with(compact('system','error'));
    }

    public function register(Request $request)
    {
        $system = Sysfigs::find(1);
        return view('pages.'.$system->theme.'.front.member.auth.registration')->with(compact('system'));
    }

    public function logout(Request $request)
    {
        if($request->session()->get('social_user'))
        {
            $request->session()->remove('social_user');
        }

        return redirect('/',302);
    }




}
