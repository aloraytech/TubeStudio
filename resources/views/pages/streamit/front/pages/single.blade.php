@extends('layouts.streamit.front.master')
@section('content')


    <!-- MainContent -->
    <div class="main-content">

        <div class="card  mt-4  bg-body text-white">
            <div class="card-title ml-3 mr-3 text-gold display-1">{{$pageData->title}}</div>
            <div class="card-body ml-2 mr-2  text-justify">{{$pageData->desc}}</div>

        </div>

    </div>




@endsection
