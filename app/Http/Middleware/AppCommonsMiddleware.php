<?php

namespace App\Http\Middleware;

use App\Models\System\Sysfigs;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AppCommonsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $system = Sysfigs::find(true);
        return View::share('system', $system);
    }
}
