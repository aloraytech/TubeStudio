<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\System\Members;
use App\Models\System\Sysfigs;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Throwable;


class AuthController extends Controller
{


    /**
     * @param Request $request
     * @return Application|Factory|string|View
     */
    public function login(Request $request)
    {
        $system = $this->systems;
        $pages = $this->pages;
        $error='';

        try{
            if($request->getMethod() === 'GET')
            {

                return view('pages.'.$system->themes->name.'.front.member.auth.login')->with(compact('system','error','pages'));
            }elseif ($request->method() === 'POST')
            {

                $credentials = $request->validate([
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
                $remember = $request->get('remember') === 'on' || $request->get('remember') === true;

                if (Auth::guard('member')->attempt($credentials,$remember)) {
                    $user = auth()->guard('member')->user();
                    $user->setAttribute('last_login', Carbon::now())->save();
                    //  $user = auth()->guard('member')->user();
                    //  $accessToken = $user->createToken('authToken')->plainTextToken;
                    $request->session()->regenerate();
                    //Api
//                    return response()->json([
//                        'success' => true, 'message' => 'Logged in successfully!',
//                        //  'accessToken' => $accessToken
//                    ], 201);
                    //Web
                    return route('member.dashboard.index');
                } else {
                    //Api
                    //return response()->json(['success' => false, 'message' => 'Authentication failed.'], 401);
                    //Web
                    $error = 'Authentication failed! Wrong Credential.';
                    return view('pages.'.$system->themes->name.'.front.member.auth.login')->with(compact('system','error','pages'));
                }
            }else{
                throw new Exception('Request Not Found!',404);
            }
        }catch (Throwable $e)
        {
            report($e);
            // Web
            $error = $e->getMessage();
            return view('pages.'.$system->themes->name.'.front.member.auth.login')->with(compact('system','error','pages'));
        }


    }

    /**
     * @param Request $request
     * @return Application|Factory|Redirector|RedirectResponse|View|void
     */
    public function register(Request $request)
    {
        $system = $this->systems;
        $pages = $this->pages;
        $error='';
        try{

            if($request->getMethod() === 'GET')
            {
                return view('pages.'.$system->themes->name.'.front.member.auth.registration')->with(compact('system','pages','error'));
            }elseif ($request->method() === 'POST')
            {
                // Do Register process
                $tc_check = $request->get('tc_check') === 'on' || $request->get('tc_check') === true;
                if($tc_check)
                {


                    $validator =
                        $request->validate([
                            'name' => 'required',
                            'email' => 'required|email',
                            'password' => 'required',
                            'c_password' => 'required|same:password',
                        ]);


                    if ($validator) {


                        $input = $request->all();
                        $input['password'] = bcrypt($input['password']);
                        $result = Members::where('email',$request->get('email'))->count();
                        if(!$result)
                        {
                            $user = Members::create($input);

                            Auth::guard('member')->login($user);
                            $accessToken = Auth::guard('member')->user()->createToken('authToken')->accessToken;
                            $error = 'Register Success, Login to access your account';
                            return redirect('login',302);
                        }else{
                            $error = 'An Account Already Exist With This Email';
                            return view('pages.'.$system->themes->name.'.front.member.auth.registration')->with(compact('system','pages','error'));
                        }


                    } else {
                        $error = 'Registration Failed!';
                        return view('pages.'.$system->themes->name.'.front.member.auth.registration')->with(compact('system','pages','error'));
                    }
                }else{
                    $error = 'Please Read & Accept Our Terms & Conditions.';
                    return view('pages.'.$system->themes->name.'.front.member.auth.registration')->with(compact('system','pages','error'));
                }

            }else{
                throw new Exception('Request Not Found!',404);
            }
        }catch (Throwable $e)
        {
            report($e);

        }



    }




    /**
     * @param Request $request
     * @return string
     */
    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $error = 'Successfully logged out';
        return route('landing.index',[$error]);
    }






    /**
     * @return JsonResponse
     */
    public function details()
    {
        $user = Auth::user();
        // $user = auth()->guard('api')->user();
        return response()->json(['data' => $user], 200);
    }













}
