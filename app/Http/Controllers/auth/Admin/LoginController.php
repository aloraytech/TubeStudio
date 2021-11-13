<?php

namespace App\Http\Controllers\auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('pages.front.auth.user.login');
//            'pages.front.index'
        }

        if ($request->isMethod('POST')) {
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
        }


        die();

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
