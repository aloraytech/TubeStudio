@extends('layouts.webtube.front.master')
@section('content')


    <div class="card">
        <div class="card-header">Movies</div>
        <div class="card-body">
            <div class="row">
                @foreach($movies as $movie)
                    <div class="card  m-2 p-2" style="width: 10rem;">
                        <img src="{{$movie->banner}}" class="img-fluid" alt="...">
                        <div class="card-body">
                            <p class="card-text">{{$movie->name}}</p>
                        </div>
                        <a class="btn btn-danger text-white btn-block" href="">Watch</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">Tv-Shows</div>
        <div class="card-body">
            <div class="row">
                @foreach($shows as $show)
                    <div class="card  m-2 p-2" style="width: 10rem;">
                        <img src="{{$show->banner}}" class="img-fluid" alt="...">
                        <div class="card-body">
                            <p class="card-text">{{$show->name}}</p>
                        </div>
                        <a class="btn btn-danger text-white btn-block" href="">Watch</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@include('optional.notice.theme_under_construction');

@endsection
