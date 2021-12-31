


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

                        @foreach($trending as $key => $show)

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
                        @foreach($trending as $key => $show)

                        <li>
                            <div class="trending-block position-relative" style="background-image: url({{$system->index_bg}});">
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
                                        <div id="trending-data1" class="overview-tab tab-pane fade active show" style="background-image: url('{{asset($show->banner) }}');background-size: 1920px 1080px;">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="javascript:void(0);" tabindex="0">
                                                    <div class="res-logo">
                                                        <div class="channel-logo">
                                                            <img src="{{$system->logo}}" class="c-logo" alt="{{(strtoupper(config('app.name')))}}">
                                                        </div>
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">{{$show->name}}</h1>
                                                <div class="d-flex align-items-center text-white text-detail">
                                                    <span class="badge badge-secondary p-3">{{$show->age_group}}</span>
                                                    <span class="ml-3">{{$show->seasons_count}} Seasons</span>
                                                    <span class="trending-year">2020</span>
                                                </div>
                                                <div class="d-flex align-items-center series mb-4">
                                                    <a href="javascript:void(0);"><img src="assets/front/images/trending/trending-label.png"
                                                                                       class="img-fluid" alt=""></a>

                                                    <span class="text-gold ml-3">#{{$key+1}} Best in {{ucfirst($system->path->show)}} Today</span>

                                                </div>
                                                <p class="trending-dec">{{\App\Helpers\BladeCustomizer::description($show->desc)}}
                                                </p>
                                                <div class="p-btns">
                                                    <div class="d-flex align-items-center p-0">
                                                        <a href="{{route('show.view',$show->name)}}" class="btn btn-hover mr-2" tabindex="0"><i
                                                                class="fa fa-play mr-2" aria-hidden="true"></i>Play Now</a>

                                                        <a href="javascript:void(0);" class="btn btn-link" tabindex="0"><i class="ri-add-line"></i>My
                                                            List</a>
                                                    </div>
                                                </div>
                                                <div class="trending-list mt-4">
{{--                                                    <div class="text-primary title">Starring: <span class="text-body">Wagner--}}
{{--                                                   Moura, Boyd Holbrook, Joanna</span>--}}
{{--                                                    </div>--}}
                                                    <div class="text-primary title">{{ucfirst($system->path->tag)}}s:
                                                        @foreach($show->tags as $tag)
                                                            <span class="text-body">{{$tag}}</span>
                                                        @endforeach
                                                    </div>
                                                    <div class="text-primary title">{{ucfirst($system->path->category)}}: <span class="text-body">{{$show->categories->name}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--First Page  OVERVIEW--}}

                                        {{--Second Page EPISODES--}}

                                        <div id="trending-data2" class="overlay-tab tab-pane fade">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="{{route('show.single',$show->name)}}" tabindex="0">
                                                    <div class="channel-logo">
                                                        <img src="{{$system->logo}}" class="c-logo" alt="{{ucfirst(config('app.name'))}}">
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">{{$show->name}}</h1>
                                                <div class="iq-custom-select d-inline-block sea-epi">
                                                    <select name="{{$system->path->show.'/'.$show->name}}" class="form-control season-select" id="seasonSelector">
                                                        @foreach($show->seasons as $seasonItem)

                                                                <option value="{{$seasonItem->name}}">{{ucfirst($seasonItem->name)}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="episodes-contens mt-4">
                                                    <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                        @foreach($show->seasons as $season)
                                                        @foreach($season->episodes as $epKey=> $episode)
                                                            <div class="e-item">
                                                                <div class="block-image position-relative">
                                                                    <a href="{{route('episode.view',[$show->name,$season->name,$episode->name])}}">
                                                                        <img src="{{$episode->display_image}}" class="img-fluid" alt="">
                                                                    </a>
                                                                    <div class="episode-number">{{ $epKey+1 }}</div>
                                                                    <div class="episode-play-info">
                                                                        <div class="episode-play">
                                                                            <a href="{{route('episode.view',[$show->name,$season->name,$episode->name])}}" tabindex="0"><i
                                                                                    class="ri-play-fill"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="episodes-description text-body mt-2">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <a href="{{route('episode.view',[$show->name,$season->name,$episode->name])}}">{{$episode->name}}</a>
                                                                        <span class="text-primary">{{\App\Helpers\BladeCustomizer::duration($episode->duration)}}</span>
                                                                    </div>
                                                                    <p class="mb-0"> {{\App\Helpers\BladeCustomizer::description($episode->desc)}}</p>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{--Second Page EPISODES--}}

                                        {{--Third Page TRAILERS --}}

                                        <div id="trending-data3" class="overlay-tab tab-pane fade">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="javascript:void(0);" tabindex="0">
                                                    <div class="channel-logo">
                                                        <img src="{{$system->logo}}" class="c-logo" alt="{{ucfirst(config('app.name'))}}">
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">{{$show->name}}</h1>

                                                <div class="episodes-contens mt-4">

                                                    <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">
                                                        @foreach($show->seasons as $season)
                                                            @foreach($season->trailers as $tKey => $trailer)
                                                        <div class="e-item">
                                                            <div class="block-image position-relative">
                                                                <a href="{{route('trailer.view',$trailer->name)}}" target="_blank">
                                                                    <img src="{{$trailer->display_image}}" class="img-fluid" alt="">
                                                                </a>
                                                                <div class="episode-number">{{$tKey+1}}</div>
                                                                <div class="episode-play-info">
                                                                    <div class="episode-play">
                                                                        <a href="{{route('trailer.view',$trailer->name)}}" target="_blank" tabindex="0"><i
                                                                                class="ri-play-fill"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="episodes-description text-body mt-2">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <a href="{{route('trailer.view',$trailer->name)}}" target="_blank">Trailer</a>
                                                                    <span class="text-primary">{{\App\Helpers\BladeCustomizer::duration($trailer->duration)}}</span>
                                                                </div>
                                                                <p class="mb-0">{{\App\Helpers\BladeCustomizer::description($trailer->desc)}}</p>
                                                            </div>
                                                        </div>
                                                            @endforeach
                                                            @endforeach
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        {{--Third Page TRAILERS--}}


                                        {{--Fourth Page SIMILAR--}}

                                        <div id="trending-data4" class="overlay-tab tab-pane fade">
                                            <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                <a href="javascript:void(0);" tabindex="0">
                                                    <div class="channel-logo">
                                                        <img src="{{$system->logo}}" class="c-logo" alt="{{(strtoupper(config('app.name')))}}">
                                                    </div>
                                                </a>
                                                <h1 class="trending-text big-title text-uppercase">the hero camp</h1>
                                                <div class="episodes-contens mt-4">
                                                    <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 mb-0">

                                                        @foreach($trending as $similarShow)
                                                        @if($show->categories_id === $similarShow->categories_id)

                                                        <div class="e-item">
                                                            <div class="block-image position-relative">
                                                                <a href="{{route('show.single',$show->name)}}">
                                                                    <img src="{{$similarShow->display_image}}" class="img-fluid" alt="">
                                                                </a>
                                                                <div class="episode-number">2</div>
                                                                <div class="episode-play-info">
                                                                    <div class="episode-play">
                                                                        <a href="{{route('show.single',$show->name)}}" tabindex="0"><i
                                                                                class="ri-play-fill"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="episodes-description text-body mt-2">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <a href="{{route('show.single',$show->name)}}">{{$similarShow->name}}</a>
                                                                    <span class="text-primary">{{$similarShow->duration}}</span>
                                                                </div>
                                                                <p class="mb-0">{{\App\Helpers\BladeCustomizer::description($similarShow->desc)}}</p>
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
