<section id="iq-trending" class="s-margin">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 overflow-hidden">
                <div class="iq-main-header d-flex align-items-center justify-content-between">
                    <h4 class="main-title">Trending</h4>
                    <a href="{{url(env('CATEGORY').'/'.env('SHOW').'s/')}}" class="text-primary">View all</a>
                </div>
                <div class="trending-contens">

                        {{--Slider Nav--}}
                    <ul id="trending-slider-nav" class="list-inline p-0 mb-0 row align-items-center">

                        {{--Show Sliders--}}

                        @foreach($shows as $show)

                        <li>
                            <a href="javascript:void(0);">
                                <div class="movie-slick position-relative">
                                    <img src="{{$show->banner}}" class="img-fluid" alt="">
                                </div>
                            </a>
                        </li>

                        @endforeach

                        {{--Show Sliders--}}
                    </ul>

                        {{--Slider Details--}}
                    <ul id="trending-slider" class="list-inline p-0 m-0  d-flex align-items-center">

                        {{--Show Details--}}
                        @foreach($shows as $show)

                        <li>
                            <div class="trending-block position-relative"
                                 style="background-image: url(images/trending/01.jpg);">
                                <div class="trending-custom-tab">
                                    <div class="tab-title-info position-relative">
                                        <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center"
                                            role="tablist">


                                            <li class="nav-item">
                                                <a class="nav-link active show" data-toggle="pill" href="#trending-data1"
                                                   role="tab" aria-selected="true">Overview</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#trending-data2" role="tab"
                                                   aria-selected="false">Episodes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#trending-data3" role="tab"
                                                   aria-selected="false">Trailers</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#trending-data4" role="tab"
                                                   aria-selected="false">Similar Like This</a>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="trending-content">
                                        {{--First Page OVERVIEW--}}
                                        <div id="trending-data1" class="overview-tab tab-pane fade active show">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="javascript:void(0);" tabindex="0">
                                                    <div class="res-logo">
                                                        <div class="channel-logo">
                                                            <img src="{{$system->logo}}" class="c-logo" alt="{{env('APP_NAME')}}">
                                                        </div>
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">{{$show->name}}</h1>
                                                <div class="d-flex align-items-center text-white text-detail">
                                                    <span class="badge badge-secondary p-3">{{$show->age_group}}</span>
                                                    <span class="ml-3">{{$show->seasons->count()}} Seasons</span>
                                                    <span class="trending-year">2020</span>
                                                </div>
                                                <div class="d-flex align-items-center series mb-4">
                                                    <a href="javascript:void(0);"><img src="assets/front/images/trending/trending-label.png"
                                                                                       class="img-fluid" alt=""></a>
                                                    <span class="text-gold ml-3">#2 in Series Today</span>
                                                </div>
                                                <p class="trending-dec">{{$show->desc}}
                                                </p>
                                                <div class="p-btns">
                                                    <div class="d-flex align-items-center p-0">
                                                        <a href="show-details.html" class="btn btn-hover mr-2" tabindex="0"><i
                                                                class="fa fa-play mr-2" aria-hidden="true"></i>Play Now</a>
                                                        <a href="javascript:void(0);" class="btn btn-link" tabindex="0"><i class="ri-add-line"></i>My
                                                            List</a>
                                                    </div>
                                                </div>
                                                <div class="trending-list mt-4">
{{--                                                    <div class="text-primary title">Starring: <span class="text-body">Wagner--}}
{{--                                                   Moura, Boyd Holbrook, Joanna</span>--}}
{{--                                                    </div>--}}
                                                    <div class="text-primary title">Tags: <span class="text-body">{{implode(', ', array_map(fn($m) => "$m", $show->tags))}}</span>
                                                    </div>
                                                    <div class="text-primary title">Category: <span class="text-body">{{$show->categories->name}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--First Page  OVERVIEW--}}

                                        {{--Second Page EPISODES--}}
                                        @foreach($show->seasons as $season)
                                        <div id="trending-data2" class="overlay-tab tab-pane fade">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="show-details.html" tabindex="0">
                                                    <div class="channel-logo">
                                                        <img src="{{$system->logo}}" class="c-logo" alt="{{env('APP_NAME')}}">
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">{{$show->name}}</h1>
                                                <div class="iq-custom-select d-inline-block sea-epi">
                                                    <select name="cars" class="form-control season-select">
                                                            @for ($i = 0; $i < $show->seasons->count(); $i++)
                                                            <option value="season{{ $i }}">Season {{ $i+1 }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="episodes-contens mt-4">
                                                    <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                        @foreach($season->episodes as $episode)
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a href="{{url(env('SHOW').'s/'.$season->name.'/'.$episode->name)}}">
                                                                        <img src="{{$episode->banner}}" class="img-fluid" alt="">
                                                                    </a>
                                                                    <div class="episode-number">{{ $i }}</div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="{{url(env('SHOW').'s/'.$season->name.'/'.$episode->name)}}" tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <a href="{{url(env('SHOW').'s/'.$season->name.'/'.$episode->name)}}">{{$episode->name}}</a>
                                                                        <span class="text-primary">{{$episode->duration}}</span>
                                                                    </div>
                                                                    <p class="mb-0"> {{$episode->desc}}</p>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        {{--Second Page EPISODES--}}

                                        {{--Third Page TRAILERS --}}
                                        @foreach($show->seasons as $season)
                                        <div id="trending-data3" class="overlay-tab tab-pane fade">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="javascript:void(0);" tabindex="0">
                                                    <div class="channel-logo">
                                                        <img src="{{$system->logo}}" class="c-logo" alt="stramit">
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">{{$show->name}}</h1>

                                                <div class="episodes-contens mt-4">

                                                    <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                            @foreach($season->trailers as $trailer)
                                                        <div class="e-item">
                                                            <div class="block-image position-relative">
                                                                <a href="{{url($system->s_url.'/watch/'.$trailer->name)}}" target="_blank">
                                                                    <img src="{{$trailer->banner}}" class="img-fluid" alt="">
                                                                </a>
                                                                <div class="episode-number">1</div>
                                                                <div class="episode-play-info">
                                                                    <div class="episode-play">
                                                                        <a href="{{url($system->s_url.'/watch/'.$trailer->title)}}" target="_blank" tabindex="0"><i
                                                                                class="ri-play-fill"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="episodes-description text-body mt-2">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <a href="{{url($system->s_url.'/watch/'.$trailer->title)}}" target="_blank">Trailer</a>
                                                                    <span class="text-primary">2.25 m</span>
                                                                </div>
                                                                <p class="mb-0">{{$trailer->desc}}</p>
                                                            </div>
                                                        </div>
                                                            @endforeach
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        @endforeach
                                        {{--Third Page TRAILERS--}}


                                        {{--Fourth Page SIMILAR--}}

                                        <div id="trending-data4" class="overlay-tab tab-pane fade">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="javascript:void(0);" tabindex="0">
                                                    <div class="channel-logo">
                                                        <img src="images/logo.png" class="c-logo" alt="stramit">
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">the hero camp</h1>
                                                <div class="episodes-contens mt-4">
                                                    <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">

                                                        @foreach($shows as $similarShow)
                                                        @if($show->categories_id === $similarShow->categories_id)

                                                        <div class="e-item">
                                                            <div class="block-image position-relative">
                                                                <a href="show-details.html">
                                                                    <img src="{{$similarShow->banner}}" class="img-fluid" alt="">
                                                                </a>
                                                                <div class="episode-number">2</div>
                                                                <div class="episode-play-info">
                                                                    <div class="episode-play">
                                                                        <a href="show-details.html" tabindex="0"><i
                                                                                class="ri-play-fill"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="episodes-description text-body mt-2">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <a href="show-details.html">{{$similarShow->name}}</a>
                                                                    <span class="text-primary">{{$similarShow->duration}}</span>
                                                                </div>
                                                                <p class="mb-0">{{$similarShow->desc}}</p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{--Fourth Page SIMILAR--}}


                                    </div>
                                </div>
                            </div>
                        </li>

                        @endforeach



                        {{--Show Details--}}
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>
