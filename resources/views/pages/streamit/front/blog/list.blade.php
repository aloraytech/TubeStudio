@extends('layouts.streamit.front.master')
@section('content')



    @if($system->has_slider)

        {{--Slider Start--}}
        @include('pages.streamit.front.components.blog.list.slider')
        {{--Slider End--}}

    @endif




    <!-- MainContent -->
    <div class="main-content">

        {{-- Popular--}}
        @include('pages.streamit.front.components.blog.list.popular')
        {{-- Popular--}}

        @if($system->has_upcoming)
            {{-- UpComing--}}
            @include('pages.streamit.front.components.blog.list.upcoming')
            {{-- UpComing--}}
        @endif


        {{-- Suggestion Shows--}}
        {{-- @include('pages.streamit.front.components.blog.list.suggestion') --}}
        {{-- Suggestion Shows--}}



        {{-- Similar Shows--}}
{{--         @include('pages.streamit.front.components.blog.list.similar')--}}
        {{-- Similar Shows --}}







        <div class="container-fluid align-self-center">

            <h2>All {{ucfirst($system->path->blog)}}s</h2>
            <div class="row mt-3">
                @foreach($allPosts as $post)
                    <div class="card-deck m-2">
                        <img src="{{$post->display_image}}" class=" img-fluid" alt="..." width="150px" height="100px">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->name}}</h5>
                            <p class="card-text">{{\App\Helpers\BladeCustomizer::description($post->desc,20)}}</p>
                            <a href="{{route('blog.view',$post->name)}}" class="btn btn-hover"> Read More</a>
                        </div>
                    </div>


                @endforeach

                {{-- Pagination--}}

                <div class="pagination">{{$allPosts->links()}}</div>
            </div>


        </div>
















    </div>






@endsection
