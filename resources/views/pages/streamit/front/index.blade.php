@extends('layouts.streamit.front.master')
@section('content')


    @if($system->slider)
            {{--Slider Start--}}
        @include('pages.streamit.front.components.index.slider')
            {{--Slider End--}}
    @endif

    <!-- MainContent -->
    <div class="main-content">
        @if($user['exist'])
            {{--Favourites--}}
{{--                @include('pages.streamit.front.components.index.favorites')--}}
            {{--End Favourites--}}
        @endif

            {{--Upcoming--}}
        @if($system->upcoming_section)
{{--                @include('pages.streamit.front.components.index.upcoming')--}}
        @endif
            {{--End Upcoming--}}

            {{--Topten--}}
{{--                @include('pages.streamit.front.components.index.topten')--}}
            {{--End Topten--}}

        @if($user['exist'])
            {{--Suggested--}}
{{--                @include('pages.streamit.front.components.index.sugested')--}}
            {{--Suggested--}}
        @endif

            {{--SingleMovie--}}
{{--                @include('pages.streamit.front.components.index.single')--}}
            {{--SingleMovie--}}


            {{--Treanding Shows--}}
                @include('pages.streamit.front.components.index.trending')
            {{--Treanding Shows--}}

            {{--Triller Shows--}}
                @include('pages.streamit.front.components.index.single')
            {{--Triller Shows--}}

    </div>

@endsection
