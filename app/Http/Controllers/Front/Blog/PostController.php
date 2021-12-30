<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function getSingle(Posts $posts, Request $request)
    {
        dd($posts);
    }


    public function getAll(Request $request)
    {
        dd($request);
    }


}
