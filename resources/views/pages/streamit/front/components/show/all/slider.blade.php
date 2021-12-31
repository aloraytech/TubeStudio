

    <!-- Slider Start -->
    <section class="iq-main-slider p-0">
        <div id="tvshows-slider">
            @foreach($sliders as $slider)
            <div>
                <a href="">
{{--                    <a href="{{route('show.view',[$slider->name])}}">--}}
                    <div class="shows-img">
                        <img src="{{$slider->banner}}" class="w-100" alt="">
                        <div class="shows-content">
                            <h4 class="text-white mb-1">{{$slider->name}}</h4>



                            <div class="movie-time d-flex align-items-center">
                                <div class="badge badge-secondary p-1 mr-2">{{$slider->age_group}}</div>
                                <span class="text-white">{{$slider->seasons_count .' '. ucfirst($system->path->season) .'s'}}</span>
                            </div>


                            @foreach ($slider->seasons as $key =>  $item)
                              @if($key === 0)
                              <div>
                                <a href="{{route('show.view',[$slider->name,$item->name])}}" class="btn btn-hover">Play Now</a>
                            </div>
                              @endif
                            @endforeach



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
                @foreach($category as $genre)
                <a class="dropdown-item" href="{{route('category.view',$genre->name)}}">{{$genre->name}}</a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Slider End -->
