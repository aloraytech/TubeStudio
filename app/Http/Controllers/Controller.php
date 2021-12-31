<?php

namespace App\Http\Controllers;

use App\Helpers\SystemHandler;
use App\Models\Blog\Pages;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected object $systems;
    protected object $pages;
    protected string $themes;

    public function __construct()
    {
        $handler = new SystemHandler();
        $this->systems = $handler->getSystem();
        $this->themes = $this->systems->theme_name;
        $this->pages = $handler->getAllPages();





    }
}
