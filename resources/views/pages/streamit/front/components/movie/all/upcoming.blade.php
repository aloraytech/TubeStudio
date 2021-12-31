
<section id="iq-favorites">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 overflow-hidden">
                <div class="iq-main-header d-flex align-items-center justify-content-between">
                    <h4 class="main-title">Upcoming {{ucfirst($system->path->movie)}}s</h4>
                </div>

                <div class="favorites-contens">
                    <ul class="favorites-slider list-inline  row p-0 mb-0">
                        @foreach ($upcoming as $item)


                        <li class="slide-item">

                                <div class="block-images position-relative">
                                    <div class="img-box">
                                        <img src="{{$item->display_image}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                        <h6>{{$item->name}}</h6>
                                        <div class="movie-time d-flex align-items-center my-2">
                                            <div class="badge badge-secondary p-1 mr-2">{{$item->age_group}} </div>
                                            <span class="text-white">{{\Illuminate\Support\Facades\Date::createFromDate($item->created_at)->format('d.m.Y')}}</span>
                                        </div>


                                        <a href="{{route('movie.view',[$item->name])}}">
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>Play Now</span>
                                            </div>
                                        </a>
                                    </div>

                                        {{-- AJAX PART --}}
                                    <div class="block-social-info">
                                        <ul class="list-inline p-0 m-0 music-play-lists">
                                            <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                            <li><span><i class="ri-heart-fill"></i></span></li>
                                            <li><span><i class="ri-add-line"></i></span></li>
                                        </ul>
                                    </div>
                                        {{-- AJAX PART --}}

                                </div>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
