@extends('layouts.webtube.front.master')
@section('content')

    <div class="card bg-dark text-white">
        <ul class="single-item">
            @foreach($shows as $show)
                <li>
                    <div class="card bg-dark" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}' >
                        <a href="{{route('show.view',$show->name)}}"><img src="{{$show->banner}}" class="" height="350px" width="1280px" alt="..."></a>
                        <div class="card-header">
{{--                            <p class="card-text">{{$show->name}}</p>--}}
                        </div>
                        {{-- Buttons--}}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>


    <h3 class="text-white">Top {{ucfirst(config('app.path.movie'))}}</h3>
<div class="card-12 bg-dark text-gold">

    <ul class="multiple-items">
        @foreach($movies as $movie)
           <li>
               <div class="card bg-dark" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}'>
                   <a href="{{route('movie.view',$movie->name)}}"><img src="{{$movie->banner}}" class="img-fluid" alt="..."></a>
                   <div class="card-header">
                       <p class="card-text">{{$movie->name}}</p>
                   </div>
                    {{-- Buttons--}}
               </div>
           </li>
        @endforeach

    </ul>
</div>




    <h3 class="text-white">Top {{ucfirst(config('app.path.show'))}}</h3>
<div class="card-12 bg-dark text-gold">

        <ul class="multiple-items">
            @foreach($shows as $show)
                <li>
                    <div class="card bg-dark" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}' >
                        <a href="{{route('show.view',$show->name)}}"><img src="{{$show->banner}}" class="img-fluid" alt="..."></a>
                        <div class="card-header">
                            <p class="card-text">{{$show->name}}</p>
                        </div>
                        {{-- Buttons--}}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>






@include('optional.notice.theme_under_construction');

@endsection
