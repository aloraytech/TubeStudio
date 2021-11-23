
<section id="home" class="iq-main-slider p-0">

    <div id="home-slider" class="slider m-0 p-0">
        {{-- Slides--}}
        @foreach($shows as $show)
            @if($show->release_on < now())
                <div class="slide slick-bg s-bg-{{$show->id}}" style="background-image: url('{{asset($show['banner']) }}');">
                    <div class="container-fluid position-relative h-100">
                        <div class="slider-inner h-100">
                            <div class="row align-items-center  h-100">
                                <div class="col-xl-6 col-lg-12 col-md-12">
                                    <a href="javascript:void(0);">
                                        <div class="channel-logo" data-animation-in="fadeInLeft" data-delay-in="0.5">
                                            <img src="{{asset('assets/front/images/logo.png')}}" class="c-logo" alt="&nbsp;Watch Later">
                                        </div>
                                    </a>
                                    <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft"
                                        data-delay-in="0.6">{{$show['name']}}</h1>
                                    <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="1">
                                        <span class="badge badge-secondary p-2">{{$show['age_group']}}</span>
                                        <span class="ml-3">{{$show->seasons->count()}} Seasons</span>
                                    </div>
                                    <p data-animation-in="fadeInUp" data-delay-in="1.2">{{$show['desc']}}
                                    </p>
                                    <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp" data-delay-in="1.2">
                                        <a href="{{url(env('SHOW').'s/'.$show['name'])}}" class="btn btn-hover"><i class="fa fa-play mr-2"
                                                                                                                     aria-hidden="true"></i>Play Now</a>
                                        <a href="{{url(env('SHOW').'s/'.$show['name'])}}" class="btn btn-link">More details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="trailor-video">
                                <a href="{{asset(env('TRAILER').'s/'.$show->videos->path_url)}}" class="video-open playbtn">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         x="0px" y="0px" width="80px" height="80px" viewBox="0 0 213.7 213.7"
                                         enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                              <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                       stroke-linejoin="round" stroke-miterlimit="10"
                                       points="73.5,62.5 148.5,105.8 73.5,149.1 " />
                                        <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8" r="103.3" />
                           </svg>
                                    <span class="w-trailor">Watch Trailer</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                fill="none" stroke="currentColor">
            <circle r="20" cy="22" cx="22" id="test"></circle>
        </symbol>
    </svg>
</section>

