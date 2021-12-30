<section id="iq-upcoming-movie">
    <div class="container-fluid">
        <div class="row">





                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                         <h4 class="main-title">{{'Best Similar '.ucfirst($system->path->category)}}</h4>
                    </div>

                    <div class="upcoming-contens">
                        <ul class="favorites-slider list-inline  row p-0 mb-0">

                            {{-- First Category Show by Modified Time --}}
                            @foreach($similar as $catItem)
                                <li class="slide-item">

                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="{{$item->banner}}" class="img-fluid" alt="">
                                        </div>
                                        <div class="block-description">
                                            <h6>{{$item->name}}</h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                            </div>
                                            <a href="{{route('category.view',[$item->name])}}">
                                                <div class="hover-buttons">
                                                    <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>View More</span>
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
