
@extends('layouts.streamit.front.master')
@section('content')



    <!-- Slider Start -->
    <section class="iq-main-slider p-0">

        <div id="tvshows-slider">
            @foreach($sliders as $slide)
            <div>
                <a href="{{url($system->path->movie.'s/'.$slide->name)}}">
                    <div class="shows-img">
                        <img src="{{$slide->banner}}" class="w-100" alt="">
                        <div class="shows-content">
                            <h4 class="text-white mb-1">{{$slide->name}}</h4>
                            <div class="movie-time d-flex align-items-center">
                                <div class="badge badge-secondary p-1 mr-2">{{$slide->age_group}}</div>
{{--                                <span class="text-white">{{//\App\Helpers\BladeCustomizer::duration($slide->duration)}}</span>--}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>


        <div class="dropdown genres-box">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
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



    <!-- MainContent -->
    <div class="main-content">
        <section id="iq-favorites">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Popular Movies</h4>
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/01.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Day of Darkness</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">15+</div>
                                                    <span class="text-white">2 Seasons</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/02.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>My True Friends</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">7+</div>
                                                    <span class="text-white">2 Seasons</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/03.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Arrival 1999</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">11+</div>
                                                    <span class="text-white">3 Seasons</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/04.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Night Mare</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">18+</div>
                                                    <span class="text-white">3 Seasons</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/05.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>The Marshal King</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">17+</div>
                                                    <span class="text-white">1 Season</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- UpComing--}}
        <section id="iq-upcoming-movie">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Upcoming {{ucfirst($system->path->movie)}}s</h4>
                        </div>
                        <div class="upcoming-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">
                                @foreach($upcoming as $up)
                                    <li class="slide-item">
                                        <a href="{{route('movie.view',$up->movies->name)}}">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img src="{{$up->movies->display_image}}" class="img-fluid" alt="">
                                                </div>
                                                <div class="block-description">
                                                    <h6>{{$up->movies->name}}</h6>
                                                    <div class="movie-time d-flex align-items-center my-2">
                                                        <div class="badge badge-secondary p-1 mr-2">{{$up->movies->age_group}}</div>
                                                        <span class="text-white">{{$up->movies_count}}</span>
                                                    </div>
                                                    <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play
                                          Now</span>
                                                    </div>
                                                </div>
                                                <div class="block-social-info">
                                                    <ul class="list-inline p-0 m-0 music-play-lists">
                                                        <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                        <li><span><i class="ri-heart-fill"></i></span></li>
                                                        <li><span><i class="ri-add-line"></i></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- UpComing--}}

        <section id="iq-suggestede">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Shows We Recommend</h4>
                        </div>
                        <div class="suggestede-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/01.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Day of Darkness</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">15+</div>
                                                    <span class="text-white">2 Seasons</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover">
                                          <i class="fa fa-play mr-1" aria-hidden="true"></i> Play Now
                                       </span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/08.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Mission Moon</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">18+</div>
                                                    <span class="text-white">3 Seasons</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/09.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Friends</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">10+</div>
                                                    <span class="text-white">1 Season</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/05.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>The Marshal King</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">17+</div>
                                                    <span class="text-white">1 Season</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="slide-item">
                                    <a href="show-single.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/tvthrillers/04.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Knight Mare</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">18+</div>
                                                    <span class="text-white">3 Seasons</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Read Now</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                    <li><span><i class="ri-heart-fill"></i></span></li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        {{-- Popular Category Shows--}}
        <section id="iq-upcoming-movie">
            <div class="container-fluid">
                <div class="row">
                    @foreach($allCategoryPosts as $cat)
                        <div class="col-sm-12 overflow-hidden">
                            <div class="iq-main-header d-flex align-items-center justify-content-between">
                                <h4 class="main-title">{{'Best '.ucfirst($cat->name) .' '. ucfirst($system->path->blog).'s'}}</h4>
                            </div>
                            <div class="upcoming-contens">
                                <ul class="favorites-slider list-inline  row p-0 mb-0">
                                    @foreach($allCategoryPosts as $up)
                                        @if($cat->id === $up->id)
                                            <li class="slide-item">
                                                <a href="{{route('movie.view',$up->posts->title)}}">
                                                    <div class="block-images position-relative">
                                                        <div class="img-box">
                                                            <img src="{{$up->posts->display_image}}" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="block-description">
                                                            <h6>{{$up->posts->title}}</h6>
                                                            <div class="movie-time d-flex align-items-center my-2">
                                                                <div class="badge badge-secondary p-1 mr-2">{{$up->posts->age_group}}</div>
                                                                <span class="text-white">{{$up->postss_count}}</span>
                                                            </div>
                                                            <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Read
                                          Now</span>
                                                            </div>
                                                        </div>
                                                        <div class="block-social-info">
                                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                                <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                                <li><span><i class="ri-heart-fill"></i></span></li>
                                                                <li><span><i class="ri-add-line"></i></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- Popular Category Shows--}}


    </div>







@endsection
