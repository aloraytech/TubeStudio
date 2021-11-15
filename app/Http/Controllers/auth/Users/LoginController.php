<?php

namespace App\Http\Controllers\auth\Users;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        if ($request->isMethod('GET')) {
            return view('pages.front.user.auth.login');
        }

        if ($request->isMethod('POST')) {
           // $request->role = 'subscriber';

                    $credentials = $request->validate([
                    'email' => 'required|email',
                    'password' => 'required'
        ]);


        if (Auth::guard('web')->attempt($credentials)) {
            $user = auth()->guard('web')->user();
            $accessToken = $user->createToken('authToken')->plainTextToken;
            return response()->json(['success' => true, 'accessToken' => $accessToken], 200);
        } else {
            return response()->json(['success' => false, 'Authentication failed.'], 400);
        }
        }




//        $credentials = $request->validate([
//            'email' => 'required|email',
//            'password' => 'required'
//        ]);
//
//
//        if (Auth::guard('api')->attempt($credentials)) {
//            $user = auth()->guard('api')->user();
//            $accessToken = $user->createToken('authToken')->plainTextToken;
//            return response()->json(['success' => true, 'accessToken' => $accessToken], 200);
//        } else {
//            return response()->json(['success' => false, 'Authentication failed.'], 400);
//        }






    }

}
