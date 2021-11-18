
    @if($activities->count() > 0)
        <section id="iq-favorites">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Your Favorites</h4>
                            <a href="{{url('favourites')}}" class="text-primary">View all</a>
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">
                                @foreach($activities as $activity)
                                    <li class="slide-item">
                                        <a href="{{url($system->m_url.'/'.$activity->movies->name)}}">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img src="{{$activity->movies->banner}}" class="img-fluid" alt="">
                                                </div>
                                                <div class="block-description">
                                                    <h6>Champions</h6>
                                                    <div class="movie-time d-flex align-items-center my-2">
                                                        <div class="badge badge-secondary p-1 mr-2">13+</div>
                                                        <span class="text-white">2h 30m</span>
                                                    </div>
                                                    <div class="hover-buttons">
                                          <span class="btn btn-hover">
                                          <i class="fa fa-play mr-1" aria-hidden="true"></i>
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
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

