
@extends('layouts.streamit.front.master')
@section('content')



    <!-- Slider Start -->
    <section class="iq-main-slider p-0">

        <div id="tvshows-slider">
            @foreach($movies as $movie)
            <div>
                <a href="{{url(env('MOVIE').'s/'.$movie->name)}}">
                    <div class="shows-img">
                        <img src="{{$movie->banner}}" class="w-100" alt="">
                        <div class="shows-content">
                            <h4 class="text-white mb-1">{{$movie->name}}</h4>
                            <div class="movie-time d-flex align-items-center">
                                <div class="badge badge-secondary p-1 mr-2">{{$movie->age_group}}</div>
                                <span class="text-white">{{\App\Helpers\BladeCustomizer::duration($movie->duration)}}</span>
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
            <div class="dropdown-menu three-column" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Hindi</a>
                <a class="dropdown-item" href="#">Tamil</a>
                <a class="dropdown-item" href="#">Punjabi</a>
                <a class="dropdown-item" href="#">English</a>
                <a class="dropdown-item" href="#">Comedies</a>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Romance</a>
                <a class="dropdown-item" href="#">Dramas</a>
                <a class="dropdown-item" href="#">Bollywood</a>
                <a class="dropdown-item" href="#">Hollywood</a>
                <a class="dropdown-item" href="#">Children & Family</a>
                <a class="dropdown-item" href="#">Award-Winning</a>
            </div>
        </div>

    </section>
    <!-- Slider End -->


    <!-- MainContent -->
    <div class="main-content">
        <section id="iq-favorites">
            <div class="container-fluid">
                <div class="row">
                    @foreach($category as $cat)
                        @foreach($movies as $movie)
                            @if($movie->categories->id === $cat->id)
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">{{$movie->categories->name}}</h4>
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">

                                <li class="slide-item">
                                    <a href="{{url(env('MOVIE').'s/'.$movie->name)}}">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="{{$movie->banner}}" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>{{$movie->name}}</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">{{$movie->age_group}}</div>
                                                    <span class="text-white">{{\App\Helpers\BladeCustomizer::duration($movie->duration)}}</span>
                                                </div>
                                                <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play Now
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

                            </ul>
                        </div>
                    </div>
                            @endif
                        @endforeach
                    @endforeach


                </div>

            </div>
        </section>


        <section id="iq-upcoming-movie">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Best Bengali Movies</h4>
                        </div>
                        <div class="upcoming-contens">
                            <ul class="favorites-slider list-inline row p-0 mb-0">
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/01.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>The Illusion</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">10+</div>
                                                    <span class="text-white">3h 15m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/02.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Burning</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">13+</div>
                                                    <span class="text-white">2h 20m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/03.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Hubby Kubby</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">9+</div>
                                                    <span class="text-white">2h 40m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/04.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Open Dead Shot</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">16+</div>
                                                    <span class="text-white">1h 40m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/05.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Jumboo Queen</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">15+</div>
                                                    <span class="text-white">3h</span>
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>







        <section id="iq-suggestede">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Movies We Recommend</h4>
                        </div>
                        <div class="suggestede-contens">
                            <ul class="list-inline favorites-slider row p-0 mb-0">
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/06.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>The Lost Journey</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">20+</div>
                                                    <span class="text-white">2h 15m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/07.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Boop Bitty</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">11+</div>
                                                    <span class="text-white">2h 30m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/08.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Unknown Land</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">17+</div>
                                                    <span class="text-white">2h 30m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/09.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Blood Block</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">13+</div>
                                                    <span class="text-white">2h 30m</span>
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
                                <li class="slide-item">
                                    <a href="movie-details.html">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img src="images/movies/10.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="block-description">
                                                <h6>Champions</h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                    <div class="badge badge-secondary p-1 mr-2">13+</div>
                                                    <span class="text-white">2h 30m</span>
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>






@endsection
