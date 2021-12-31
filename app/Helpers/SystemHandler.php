<?php

namespace App\Helpers;

use App\Models\Blog\Pages;
use App\Models\System\Systems;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

class SystemHandler
{

    private object $system;
    private PathCustomizer $customizer;

    public function __construct()
    {
//        if (Cache::has('system_query')) {
//            $this->system = Cache::get('system_query', function () {
//                return $this->resolveSystem();
//            });
//        }else{
//            $this->system = Cache::remember('system_query',10, function () {
//                return $this->resolveSystem();
//            });
//        }
        $this->customizer = new PathCustomizer();
        $this->system = $this->resolveSystem();

    }



    public function getSystem()
    {
        return $this->get();
    }

    public function get()
    {
        return $this->getfilter();
    }

    public function getTheme()
    {
        return $this->themes->name;
    }

    public function getThemeType()
    {
        return $this->system->themes->type;
    }

    public function getLimit()
    {
        return $this->system->per_page;
    }


    public function getAllPages()
    {

        if (Cache::has('pages_query')) {
            return Cache::get('pages_query', function () {
                return $this->resolvePages();
            });
        }else{
            return Cache::remember('pages_query',10, function () {
                return $this->resolvePages();
            });
        }

    }



    public function isValid()
    {
        if($this->system->valid_secret)
        {
            return true;
        }
        return false;
    }

    public function trial_checker()
    {
        if($this->system->valid_upto > now())
        {
            return [
                'status' => true,
                'remain' => $this->system->valid_upto - now(),
            ];
        }else{
            return [
                'status' => true,
                'remain' => 0,
            ];
        }
    }



    private function resolvePages()
    {
        return Pages::where('status',true)->orderby('position','asc')->limit(20)->get();
    }



    private function resolveSystem()
    {
        return Systems::with('themes')->first();
    }


    private function getfilter()
    {
        return json_decode(json_encode([
            'keywords' => $this->system->keywords,
            'desc' => $this->system->desc,
            'header'=> $this->system->header,
            'logo' => $this->system->logo,
            'favicon' => $this->system->favicon,
            'slogan' => $this->system->slogan,
            'lang' => $this->system->lang,
            'limit'=> $this->system->per_page,
            'installed' => $this->system->installed,
            'coming_soon'=> $this->system->coming_soon,
            'coming_soon_upto'=> $this->system->coming_soon_upto,
            'has_slider' => $this->system->has_slider,
            'has_upcoming' => $this->system->has_upcoming,
            "movie_pack" => $this->system->movie_pack,
            "show_pack" => $this->system->show_pack,
            "trailer_pack" => $this->system->trailer_pack,
            "blog_pack" => $this->system->blog_pack,
            "advert_pack" => $this->system->advert_pack,
            "social_pack" => $this->system->social_pack,
            "shop_pack" => $this->system->shop_pack,
            "private_pack" => $this->system->private_pack,
            "payment_pack" => $this->system->payment_pack,
            'activity_pack' => $this->system->activity_pack,
            "valid_secret" => $this->system->valid_secret,
            'client_email' => $this->system->client_email,
            'suite_by' => $this->system->suite_by,
            'theme_name'=> $this->system->themes->name,
            'theme_type'=> $this->system->themes->type,
            'player' => $this->system->player_size,
            'index_bg'=> $this->system->index_bg,
            'login_bg'=> $this->system->login_bg,
            'register_bg' => $this->system->register_bg,
            'path' => $this->customizer->getPath(),
        ]));
    }



}
