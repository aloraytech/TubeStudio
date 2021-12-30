

<!-- Slider Start -->
<section class="iq-main-slider p-0">
    <div id="tvshows-slider">
        @foreach($sliders as $slider)
            <div>
                <a href="">
                    {{--                    <a href="{{route('show.view',[$slider->name])}}">--}}
                    <div class="shows-img">
                        <img src="{{$slider->banner}}" class="w-100" height="600" alt="">
                        <div class="shows-content">
                            <h2 class="text-white mb-1 display-1">{{$slider->name}}</h2>



                            <div class="movie-time d-flex align-items-center">
{{--                                <div class="badge badge-secondary p-1 mr-2">{{$slider->type}}</div>--}}
                                <span class="text-white">{{\App\Helpers\BladeCustomizer::description($slider->desc) }}</span>
                            </div>


                            <div class="mt-2 mb-2">
                                <a href="{{route('category.view',[$slider->name])}}" class="btn btn-hover">View All</a>
                            </div>



                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    <div class="dropdown genres-box">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Genres
        </button>
        <div class="dropdown-menu three-column" aria-labelledby="dropdownMenuButton2">
            @foreach($allCategory as $genre)
                <a class="dropdown-item" href="{{route('category.view',$genre->name)}}">{{$genre->name}}</a>
            @endforeach
        </div>
    </div>
</section>
<!-- Slider End -->
