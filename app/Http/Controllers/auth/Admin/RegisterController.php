<?php

namespace App\Http\Controllers\auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        if ($request->isMethod('GET')) {
            return view('pages.front.auth.admin.registration');
        }

        if ($request->isMethod('POST')) {
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
        }





        $validator =
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'contact'=> 'required',
                'whatsapp'=>'required',
            ]);


        //checking if the email is verified with otp
        $otpVerified = true;
        //OtpVerify::where('temp_email', $request->email)->first();




        if ($otpVerified && $validator) {


            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = Customer::create($input);

            Auth::login($user);
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            // Mail::to($request->email)->send(new WelcomeUser($input));
            //Triggers event queue
            // event(new CustomerRegistered($user));
            // return response()->json([
            //     'success' => true, 'message' => 'Account created successfully.',
            //     'token' => $accessToken
            // ], 200);
            return "Register Success";
        } else {
            return response()->json(['success' => false, 'message' => 'error'], 400);
        }
    }
}
