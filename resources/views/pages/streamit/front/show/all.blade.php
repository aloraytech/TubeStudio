@extends('layouts.streamit.front.master')
@section('content')



@if($system->has_slider)

    {{--Slider Start--}}
    @include('pages.streamit.front.components.show.all.slider')
    {{--Slider End--}}

@endif




    <!-- MainContent -->
    <div class="main-content">

        {{-- Popular--}}
            @include('pages.streamit.front.components.show.all.popular')
        {{-- Popular--}}

        @if($system->has_upcoming)
        {{-- UpComing--}}
            @include('pages.streamit.front.components.show.all.upcoming')
        {{-- UpComing--}}
        @endif


        {{-- Suggestion Shows--}}
            @include('pages.streamit.front.components.show.all.suggestion')
        {{-- Suggestion Shows--}}



        {{-- Similar Shows--}}
            {{-- @include('pages.streamit.front.components.show.all.similar') --}}
        {{-- Similar Shows --}}


    </div>






@endsection
