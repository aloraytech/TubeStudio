@extends('layouts.streamit.front.master')
@section('content')

{{--        SINGLE SEASON PART--}}
    <!-- Banner Start -->
    <section class="banner-wrapper overlay-wrapper iq-main-slider" style="background-image: url('{{$allSeasons->banner}}')">
        @foreach($seasonEpisode->episodes as $episode)
            <div class="banner-caption">
                <div class="position-relative mb-4">
                    <a href="{{route('episode.view',[$shows->name,$seasonEpisode->name,$episode->name])}}" class="d-flex align-items-center">
                        <div class="play-button">
                            <i class="fa fa-play"></i>
                        </div>
                        <h4 class="w-name text-white font-weight-700">Watch First Episode</h4>
                    </a>
                </div>
                <ul class="list-inline p-0 m-0 share-icons music-play-lists">
                    <li><span><i class="ri-add-line"></i></span></li>
                    <li><span><i class="ri-heart-fill"></i></span></li>
                    <li class="share">
                        <span><i class="ri-share-fill"></i></span>
                        <div class="share-box">
                            <div class="d-flex align-items-center">
                                <a href="#" class="share-ico"><i class="ri-facebook-fill"></i></a>
                                <a href="#" class="share-ico"><i class="ri-twitter-fill"></i></a>
                                <a href="#" class="share-ico"><i class="ri-links-fill"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endforeach
    </section>
    <!-- Banner End -->



    <!-- MainContent -->
    <div class="main-content">

            {{-- SHOW DETAIL--}}
        <section class="movie-detail container-fluid">
            <div class="row">
                @if(!empty($allSeasons->tags))
                    <div class="col-lg-12">
                        <div class="trending-info g-border">
                            <h1 class="trending-text big-title text-uppercase mt-0">{{$allSeasons->name}}</h1>
                            <ul class="p-0 list-inline d-flex align-items-center movie-content">
                                    {{-- Show Tag List--}}
                                    @if(is_array($allSeasons->tags))
                                    @foreach($allSeasons->tags as $tag )
                                        <li class="text-white">{{$tag}}</li>
                                    @endforeach
                                    @endif
                                {{-- Show Tag List--}}
                            </ul>

                            <div class="d-flex align-items-center text-white text-detail">
                                <span class="badge badge-secondary p-3">{{$allSeasons->age_group}}</span>
                                <span class="ml-3">{{$allSeasons->count() .' '. ucfirst($system->path->season).'s'}}
                                    - {{$totalEpisodesCount .' '. ucfirst($system->path->episode).'s'}}
                                </span>
                                <span class="trending-year">{{\Illuminate\Support\Facades\Date::create($episode->modified_at)->format('Y')}}</span>
                            </div>

                            <div class="d-flex align-items-center series mb-4">
                                <a href="javascript:void();"><img src="images/trending/trending-label.png" class="img-fluid"
                                                                  alt=""></a>
    {{--                            <span class="text-gold ml-3">#2 in Series Today</span>--}}
                            </div>
                            <p class="trending-dec w-100 mb-0">{{str_replace('<p>','',str_replace('</p>','',$allSeasons->desc))}}</p>

                        </div>
                    </div>
                @endif
            </div>
        </section>
        {{-- SHOW DETAIL--}}

        <section class="container-fluid seasons">
            <div class="iq-custom-select d-inline-block sea-epi s-margin">
                <select name="{{$system->path->show.'s/'.$allSeasons->name}}" class="form-control season-select" id="seasonSelector">
                    @foreach($allSeasons->seasons as $season)
                    <option value="{{$season->name}}">{{ucfirst($season->name)}}</option>
                    @endforeach
                </select>
            </div>
                {{--Tabs--}}
            <ul class="trending-pills d-flex nav nav-pills align-items-center text-center s-margin" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" data-toggle="pill" href="#episodes" role="tab"
                       aria-selected="true">Episodes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#popularclips" role="tab" aria-selected="false">Popular
                        Clips</a>
                </li>
            </ul>


            <div class="tab-content">
                    {{--Active Season Episodes--}}
                <div id="episodes" class="tab-pane fade active show" role="tabpanel">
                    <div class="block-space">
                        <div class="row">
                            @foreach($firstSeasonDetail as $seasonDetail)


                            @foreach($seasonDetail->episodes as $key => $episode)

                            <div class="col-1-5 col-md-6 iq-mb-30" id="episode-card">
                                <div class="epi-box">
                                    <div class="epi-img position-relative">
                                        <img src="{{$episode->display_image}}" class="img-fluid img-zoom" alt="">
                                        <div class="episode-number">{{$key+1}}</div>
                                        <div class="episode-play-info">
                                            <div class="episode-play">
                                                <a href="{{route('episode.view',[$shows->name,$seasonEpisode->name,$episode->name])}}">
{{--                                                    Route--}}
                                                    <i class="ri-play-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="epi-desc p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-white">{{\Illuminate\Support\Facades\Date::createFromDate($episode->release_on)->format("Y/m/d")}}</span>
                                            <span class="text-primary">{{\App\Helpers\BladeCustomizer::duration($episode->duration)}}</span>
                                        </div>
                                        <a href="{{route('episode.view',[$shows->name,$seasonEpisode->name,$episode->name])}}">
                                            <h6 class="epi-name text-white mb-0"> {{str_replace('<p>','',str_replace('</p>','',$episode->desc))}} </h6>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                            @endforeach

                        </div>
                    </div>
                </div>
                {{--Active Season Episodes--}}

                {{--Active Season Trailers--}}
                <div id="popularclips" class="tab-pane fade" role="tabpanel">
                    <div class="block-space">
                        <div class="row">
                            @foreach($firstSeasonDetail as $seasonDetail)
                            @foreach($seasonDetail->trailers as $trailer)

                            <div class="col-1-5 col-md-6 iq-mb-30">
                                <div class="epi-box">
                                    <div class="epi-img position-relative">
                                        <img src="{{$trailer->display_image}}" class="img-fluid img-zoom" alt="">
                                        <div class="episode-number">1</div>
                                        <div class="episode-play-info">
                                            <div class="episode-play">
                                                <a href="{{route('trailer.view',$trailer->name)}}">
                                                    <i class="ri-play-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="epi-desc p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-white">{{$trailer->created_at}}</span>
                                            <span class="text-primary">{{\App\Helpers\BladeCustomizer::duration($trailer->duration)}}</span>
                                        </div>
                                        <a href="show-details.html">
                                            <h6 class="epi-name text-white mb-0">Lorem Ipsum is simply dummy text
                                            </h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                {{--Active Season Trailers--}}
            </div>
        </section>
    </div>


@endsection
