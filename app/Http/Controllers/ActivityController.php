<?php

namespace App\Http\Controllers;

use App\Models\System\Activities;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    private Activities $activities;

    public function __construct()
    {
        $this->activities = Activities::with('members','movies','episodes','shows','seasons','posts')->orderby('updated_at','desc')->all();
    }

    public function get(){}

    public function create(){}

    public function update(){}

    public function delete(){}



}
