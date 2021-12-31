@extends('layouts.streamit.front.master')
@section('content')


    <!-- MainContent -->
    <div class="main-content">

        <div class="container">
            <div class="card  mt-4  bg-body text-white">
                <div class="card-title ml-3 mr-3 text-gold display-1">{{$posts->name}}</div>
                <span>{{ ucfirst($system->path->category) .' : '. $posts->categories->name }}</span>
                <div class="card-body ml-2 mr-2  text-justify">{{$posts->desc}}</div>

            </div>
        </div>

    </div>


    {{-- Popular--}}
    @include('pages.streamit.front.components.blog.single.similar')
    {{-- Popular--}}


@endsection
