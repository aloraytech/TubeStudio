<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\System\Members;
use App\Models\System\Socials;
use App\Models\System\Sysfigs;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{


    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param string $social
     * @return JsonResponseAlias
     */
    public function redirectToSocial(string $social)
    {
        $validated = $this->validateSocial($social);
        if (!is_null($validated)) {
            return $validated;
        }
        return Socialite::driver($social)->stateless()->redirect();
    }


    /**
     * Obtain the user information from Provider.
     * @param $social
     * @return Application|JsonResponseAlias|RedirectResponse|Redirector|void
     */
    public function handleSocialCallback($social)
    {
        $validated = $this->validateSocial($social);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $socialDetail = Socialite::driver($social)->stateless()->user();
        } catch (ClientException $exception) {
            // Api Response
            //return response()->json(['error' => 'Invalid credentials provided.'], 422);
            // Web Response
            $system = Sysfigs::find(1);
            $error='Unable to login using' . $social . '. Please try again.';
            return view('pages.'.$system->theme.'.front.member.auth.login')->with(compact('system','error'));
            //return redirect(env('CLIENT_BASE_URL') . '?error=Unable to login using' . $social . '. Please try again.');
        }

        $existMember = $this->memberExist($socialDetail,$social);




        if(!$existMember->count())
        {
            $member = Members::firstOrCreate([
                'name'=> $socialDetail->getName(),
                'email'=> $socialDetail->getEmail(),
                'email_verified_at' => now(),
                'password'=> null,
                'status' => true,
            ]);
            if(!$member->hasSocial($social))
            {
                $member->socials()->updateOrCreate([
                    'social_id'=> $socialDetail->getId(),
                    'social'=> $social,
                    'members_id'=> $member->id,
                    'avatar' => $socialDetail->getAvatar()
                ]);
            }
            Auth::guard('member')->login($member);
        }else{
            Auth::guard('member')->login($existMember);
        }



        if (Auth::guard('member')->check()) {
            $accessToken = Auth::guard('member')->user()->createToken('authToken')->accessToken;

            //return redirect(url('/') . '/auth/social-callback?token=' . $accessToken);
            return redirect(url('/dashboard'),302);
        } else {
            return response()->json(['error' => 'social login error']);
        }



//        $token = $userCreated->createToken('token-name')->plainTextToken;

        // For Api
        //return response()->json($userCreated, 200, ['Access-Token' => $token]);
        //For Web
//        return redirect(url('/dashboard'),302);
    }

    /**
     * @param $social
     * @return JsonResponseAlias|void
     */
    protected function validateSocial($social)
    {
        if (!in_array($social, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }




    private function memberExist($detail,$social)
    {
        if($this->validateSocial($social))
        {
            // Check Social Record
            $socialMember = Socials::where('social_id', $detail->getId())->first();
            return $socialMember ? $socialMember->user : null;
        }else{
            // Check Member Tables
            return Members::where('email', $detail->getEmail())->orWhereHas('socials', function ($q) use ($detail, $social) {
                $q->where('social_id', $detail->getId())->where('social', $social);
            })->first();
        }
    }







}
