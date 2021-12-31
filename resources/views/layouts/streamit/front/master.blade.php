
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Keywords" content="{{$system->keywords}}">
    <meta name="Description" content="{{$system->desc}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset($system->favicon)}}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/front/css/bootstrap.min.css')}}" />
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/front/css/typography.css')}}">
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('public/assets/front/css/style.css')}}" />
    <!-- Responsive -->
    <link rel="stylesheet" href="{{asset('public/assets/front/css/responsive.css')}}" />
    <!-- App-Header -->
    {{\App\Helpers\BladeCustomizer::header_maker($system->header)}}

</head>
<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
@include('layouts.streamit.front.components.header')
@yield('content')
@include('layouts.streamit.front.components.modal')
@include('layouts.streamit.front.components.footer')

<!-- MainContent End-->
<!-- back-to-top -->
<div id="back-to-top">
    <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
</div>
<!-- back-to-top End -->
<!-- jQuery, Popper JS -->
<script src="{{asset('public/assets/front/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('public/assets/custom.js')}}"></script>
<script src="{{asset('public/assets/front/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('public/assets/front/js/bootstrap.min.js')}}"></script>
<!-- Slick JS -->
<script src="{{asset('public/assets/front/js/slick.min.js')}}"></script>
<!-- owl carousel Js -->
<script src="{{asset('public/assets/front/js/owl.carousel.min.js')}}"></script>
<!-- select2 Js -->
<script src="{{asset('public/assets/front/js/select2.min.js')}}"></script>
<!-- Magnific Popup-->
<script src="{{asset('public/assets/front/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Slick Animation-->
<script src="{{asset('public/assets/front/js/slick-animation.min.js')}}"></script>
<!-- Custom JS-->
<script src="{{asset('public/assets/front/js/custom.js')}}"></script>
<script src="{{asset('public/assets/front/js/userscript.js')}}"></script>

</body>
</html>

