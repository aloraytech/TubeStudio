<?php

namespace App\Http\Controllers;

use App\Helpers\YoutubeHelper;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{


    public function index()
    {
//        $id =1;
//        return view('pages.front.index', [
//            //'user' => User::findOrFail($id)
//            'name'=>'amal'
//        ]);

        $youtube = new YoutubeHelper();
       // dd($youtube->analyze());

        return view('pages.front.index');


    }


}
