@extends('layouts.streamit.front.master')
@section('content')



    @if(empty($content))
        @if($system->has_slider)
            {{--Slider Start--}}
            @include('pages.streamit.front.components.category.slider')
            {{--Slider End--}}

        @endif
    @else
        <div class="card bg-dark text-white">
            <img src="{{$content->banner}}" class="card-img w-100" alt="..." height="600px">
            <div class="card-img-overlay">
                <h1 class="display-1"><br><br> {{$content->name}}</h1>

                <p class="card-text display-4">{{\App\Helpers\BladeCustomizer::description($content->desc)}}</p>
            </div>

            <div class="card-footer">
                <ul class="favorites-slider list-inline  row p-0 mb-0">
                    @foreach ($contentBag as $item)


                        <li class="slide-item">

                            <div class="block-images position-relative">
                                <div class="img-box">
                                    <img src="{{$item->display_image}}" class="img-fluid" alt="">
                                </div>
                                <div class="block-description">
                                    <h6>{{$item->name}}</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                        <div class="badge badge-secondary p-1 mr-2">{{$item->age_group}}</div>
                                        @if($content->type === 'show')
                                        <span class="text-white">{{$item->seasons_count .' '. ucfirst($system->path->season) .'s'}}</span>
                                        @endif
                                    </div>

                                    @if($content->type === 'show')
                                        @foreach ($item->seasons as $key=> $sess)
                                            @if($key === 0)
                                                <a href="{{route('show.single',[$item->name,$sess->name])}}">
                                                    <div class="hover-buttons">
                                                        <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>Play Now</span>
                                                    </div>
                                                </a>
                                            @endif

                                        @endforeach
                                    @else
                                        <a href="{{route(strtolower($content->type).'.view',[$item->name])}}">
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>Play Now</span>
                                            </div>
                                        </a>
                                    @endif
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
    @endif







    <!-- MainContent -->
    <div class="main-content">

        @if(!empty($content))
        {{-- Similar Shows--}}
         @include('pages.streamit.front.components.category.similar')
        {{-- Similar Shows --}}
        @endif


{{--        All Category Here--}}

        <div class="container-fluid align-self-center">

            <h2>All {{ucfirst($system->path->category)}}</h2>
            <div class="row mt-3">
                @foreach($allCategory as $catItem)
                    <div class="card-deck m-2">
                        <img src="{{$catItem->banner}}" class=" img-fluid" alt="..." width="150px" height="100px">
                        <div class="card-body">
                            <h5 class="card-title">{{$catItem->name}}</h5>
                            <p class="card-text">{{\App\Helpers\BladeCustomizer::description($catItem->desc,20)}}</p>
                            <a href="{{route('category.view',$catItem->name)}}" class="btn btn-hover"> View More</a>
                        </div>
                    </div>


                @endforeach

                    {{-- Pagination--}}

                    <div class="pagination">{{$allCategory->links()}}</div>
            </div>


        </div>




    </div>









@endsection
