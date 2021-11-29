<?php

namespace App\Http\Controllers;

use App\Models\System\Systems;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Systems $systems;

    public function __construct()
    {
        $this->systems = Systems::find(1);
    }
}
