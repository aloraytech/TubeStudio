<?php

namespace App\Http\Controllers;

use App\Models\Blog\Pages;
use App\Models\System\Systems;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Systems $systems;
    protected Collection  $pages;
    protected $themes;

    public function __construct()
    {
        $this->systems = Systems::with('themes')->find(1);
        $this->pages = Pages::where('status',true)->orderby('position','asc')->get();


    }
}
