<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\System\Sysfigs;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function searchFront(Request $request)
    {
        $subject = $request->get('subject');
        $system = $this->systems;
        $error='';
        return view('pages.'.$system->theme.'.front.search.search')->with(compact('system','error','subject'));
    }


}
